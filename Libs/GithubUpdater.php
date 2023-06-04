<?php
namespace WordPress\Plugin\PP_WP_Basic_Security\Libs;

defined('ABSPATH') or die();

/**
 * @version 1.6
 * @author Joachim Kudish <info@jkudish.com>
 * @link http://jkudish.com
 * @package WP_GitHub_Updater
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @copyright Copyright (c) 2011-2013, Joachim Kudish
 *
 * GNU General Public License, Free Software Foundation
 * <http://creativecommons.org/licenses/GPL/2.0/>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
 */
class GithubUpdater {
    /**
     * GitHub Updater version
     */
    public const VERSION = 1.6;

    /**
     * The config for the updater
     *
     * @var $config array
     * @access public
     */
    public array $config;

    /**
     * Any config that is missing from the initialization of this instance
     *
     * @var $missingConfig
     * @access public
     */
    public $missingConfig;

    /**
     * Temporarily store the data fetched from GitHub,
     * allows us to only load the data once per class instance
     *
     * @var $githubData
     * @access private
     */
    private $githubData;

    /**
     * Class Constructor
     *
     * @param array $config the configuration required for the updater to work
     *
     * @return void
     * @see has_minimum_config()
     * @since 1.0
     */
    public function __construct(array $config = []) {
        $defaults = [
            'slug' => plugin_basename(__FILE__),
            'proper_folder_name' => dirname(plugin_basename(__FILE__)),
            'sslverify' => true,
            'access_token' => '',
        ];

        $this->config = wp_parse_args($config, $defaults);

        // if the minimum config isn't set, issue a warning and bail
        if(!$this->hasMinimumConfig()) {
            $message = __(
				'The GitHub Updater was initialized without the minimum required configuration, please check the config in your plugin. The following params are missing: ',
				'pp-wp-basic-security'
            );
            $message .= implode(',', $this->missingConfig);

            _doing_it_wrong(__CLASS__, $message, self::VERSION);

            return;
        }

        $this->setDefaults();
        $this->init();
    }

    /**
     * Fire all WordPress actions
     */
    public function init(): void {
        add_filter('pre_set_site_transient_update_plugins', [$this, 'apiCheck']);

        // Hook into the plugin details screen
        add_filter('plugins_api', [$this, 'getPluginInfo'], 10, 3);
        add_filter('upgrader_post_install', [$this, 'upgraderPostInstall'], 10, 3);

        // set timeout
        add_filter('http_request_timeout', [$this, 'httpRequestTimeout']);

        // set sslverify for zip download
        add_filter('http_request_args', [$this, 'httpRequestSslVerify'], 10, 2);
    }

    /**
     * Check if the minimum configuration is given
     *
     * @return boolean
     */
    public function hasMinimumConfig(): bool {
        $this->missingConfig = [];

        $requiredParams = [
            'api_url',
            'raw_url',
            'github_url',
            'zip_url',
            'requires',
            'tested',
            'readme',
        ];

        foreach($requiredParams as $requiredParameter) {
            if(empty($this->config[$requiredParameter])) {
                $this->missingConfig[] = $requiredParameter;
            }
        }

        return (empty($this->missingConfig));
    }

    /**
     * Check weather or not the transients need to be overruled
     * and API needs to be called for every single page load
     *
     * @return bool overrule or not
     */
    public function overruleTransients(): bool {
        return (defined('\WordPress\Plugin\PP_WP_Basic_Security\WP_GITHUB_FORCE_UPDATE') && \WordPress\Plugin\PP_WP_Basic_Security\WP_GITHUB_FORCE_UPDATE);
    }

    /**
     * Set defaults
     *
     * @since 1.2
     * @return void
     */
    public function setDefaults(): void {
        if(!empty($this->config['access_token'])) {
            // See Downloading a zipball (private repo) https://help.github.com/articles/downloading-files-from-the-command-line
            $parsedUrl = parse_url($this->config['zip_url']); // $scheme, $host, $path

            $zipUrl = $parsedUrl['scheme'] . '://api.github.com/repos' . $parsedUrl['path'];
            $zipUrl = add_query_arg(['access_token' => $this->config['access_token']], $zipUrl);

            $this->config['zip_url'] = $zipUrl;
        }

        if(!isset($this->config['new_version'])) {
            $this->config['new_version'] = $this->getNewVersion();
        }

        if(!isset($this->config['last_updated'])) {
            $this->config['last_updated'] = $this->getDate();
        }

        if(!isset($this->config['description'])) {
            $this->config['description'] = $this->getDescription();
        }

        $pluginData = $this->getPluginData();
        if(!isset($this->config['plugin_name'])) {
            $this->config['plugin_name'] = $pluginData['Name'];
        }

        if(!isset($this->config['version'])) {
            $this->config['version'] = $pluginData['Version'];
        }

        if(!isset($this->config['author'])) {
            $this->config['author'] = $pluginData['Author'];
        }

        if(!isset($this->config['homepage'])) {
            $this->config['homepage'] = $pluginData['PluginURI'];
        }

        if(!isset($this->config['readme'])) {
            $this->config['readme'] = 'README.md';
        }
    }

    /**
     * Callback fn for the http_request_timeout filter
     *
     * @since 1.0
     * @return int timeout value
     */
    public function httpRequestTimeout(): int {
        return 2;
    }

    /**
     * Callback fn for the http_request_args filter
     *
     * @param array $args
     * @param string $url
     *
     * @return array
     */
    public function httpRequestSslVerify( array $args, string $url): array {
        if($this->config['zip_url'] === $url) {
            $args['sslverify'] = $this->config['sslverify'];
        }

        return $args;
    }

	/**
	 * Get the new version from GitHub
	 *
	 * @return bool|string $version the version number
	 * @since 1.0
	 */
    public function getNewVersion(): bool|string {
        $version = get_site_transient(md5($this->config['slug']) . '_new_version');

        if((!isset($version) || !$version ) || $this->overruleTransients()) {
            $rawResponse = $this->remoteGet(trailingslashit($this->config['raw_url']) . basename($this->config['slug']));

            if(is_wp_error($rawResponse)) {
                $version = false;
            }

            if(is_array($rawResponse) && ! empty($rawResponse['body'])) {
                preg_match('/.*Version:\s*(.*)$/mi', $rawResponse['body'], $matches);
            }

            if(!empty($matches[1])) {
                $version = $matches[1];
            }

            /**
             * Back compat for older readme version handling
             * only done when there is no version found in file name
             */
            if($version === false) {
                $rawResponse = $this->remoteGet(trailingslashit($this->config['raw_url']) . $this->config['readme']);

                if(is_wp_error($rawResponse)) {
                    return $version;
                }

                preg_match('#^\s*`*~Current Version:\s*([^~]*)~#im', $rawResponse['body'], $__version);

                if(isset($__version[1])) {
                    $version_readme = $__version[1];

                    if(version_compare($version, $version_readme) === -1) {
                        $version = $version_readme;
                    }
                }
            }

            // refresh every 6 hours
            if($version !== false) {
                set_site_transient(md5($this->config['slug']) . '_new_version', $version, 60 * 60 * 6);
            }
        }

        return $version;
    }

    /**
     * Interact with GitHub
     *
     * @param string $query
     *
     * @return array|\WP_Error
     * @since 1.6
     */
    public function remoteGet(string $query): array|\WP_Error {
        if(!empty($this->config['access_token'])) {
            $query = add_query_arg(['access_token' => $this->config['access_token']], $query);
        }

	    return wp_remote_get(
				$query, ['sslverify' => $this->config['sslverify']]
	    );
    }

	/**
	 * Get GitHub Data from the specified repository
	 *
	 * @return false|mixed|null $github_data the data
	 * @since 1.0
	 */
    public function getGithubData(): mixed {
        $githubData = null;

        if(!empty($this->githubData)) {
            $githubData = $this->githubData;
        }

        if($githubData === null) {
            $githubData = get_site_transient(md5($this->config['slug']) . '_github_data');

            if((!isset($githubData) || !$githubData) || $this->overruleTransients()) {
                $githubRemoteData = $this->remoteGet($this->config['api_url']);

                if(is_wp_error($githubRemoteData)) {
                    return false;
                }

                $githubData = json_decode($githubRemoteData['body']);

                // refresh every 6 hours
                set_site_transient(md5($this->config['slug']) . '_github_data', $githubData, 60 * 60 * 6);
            }

            // Store the data in this class instance for future calls
            $this->githubData = $githubData;
        }

        return $githubData;
    }

	/**
	 * Get update date
	 *
	 * @return bool|string $date the date
	 * @since 1.0
	 */
    public function getDate(): bool|string {
        $githubData = $this->getGithubData();

        return (!empty($githubData->updated_at)) ? date('Y-m-d', strtotime($githubData->updated_at)) : false;
    }

	/**
	 * Get plugin description
	 *
	 * @return bool|string $description the description
	 * @since 1.0
	 */
    public function getDescription(): bool|string {
        $githubData = $this->getGithubData();

        return (!empty($githubData->description)) ? $githubData->description : false;
    }

    /**
     * Get Plugin data
     *
     * @return array $data the data
     * @since 1.0
     */
    public function getPluginData(): array {
        include_once(ABSPATH . '/wp-admin/includes/plugin.php');

	    return get_plugin_data(\WP_PLUGIN_DIR . '/' . $this->config['slug']);
    }

    /**
     * Hook into the plugin update check and connect to GitHub
     *
     * @param object $transient the plugin data transient
     *
     * @return object $transient updated plugin data transient
     * @since 1.0
     */
    public function apiCheck(object $transient): object {
        /**
         * Check if the transient contains the 'checked' information
         * If not, just return its value without hacking it
         */
        if(empty($transient->checked)) {
            return $transient;
        }

        // check the version and decide if it's new
        $update = version_compare($this->config['new_version'], $this->config['version']);

        if($update === 1) {
            $response = new \stdClass;
            $response->new_version = $this->config['new_version'];
            $response->slug = $this->config['proper_folder_name'];
            $response->url = add_query_arg(
				['access_token' => $this->config['access_token']],
				$this->config['github_url']
            );
            $response->package = $this->config['zip_url'];

            $transient->response[$this->config['slug']] = $response;
        }

        return $transient;
    }

	/**
	 * Get Plugin info
	 *
	 * @param bool $false always false
	 * @param string $action the API function being performed
	 * @param object $response
	 *
	 * @return object|bool
	 * @since 1.0
	 */
    public function getPluginInfo( bool $false, string $action, object $response): object|bool {
        /**
         * Since they are not even used, but propagated by WP to this callback,
         * let's unset them ....
         */
	    unset($false, $action);

	    // Check if this call API is for the right plugin
        if(!isset($response->slug) || $response->slug !== $this->config['slug']) {
            return false;
        }

        $response->slug = $this->config['slug'];
        $response->plugin_name = $this->config['plugin_name'];
        $response->version = $this->config['new_version'];
        $response->author = $this->config['author'];
        $response->homepage = $this->config['homepage'];
        $response->requires = $this->config['requires'];
        $response->tested = $this->config['tested'];
        $response->downloaded = 0;
        $response->last_updated = $this->config['last_updated'];
        $response->sections = ['description' => $this->config['description']];
        $response->download_link = $this->config['zip_url'];

        return $response;
    }

    /**
     * Upgrader/Updater
     * Move & activate the plugin, echo the update message
     *
     * @param boolean $true always true
     * @param mixed $hookExtra not used
     * @param array $result the result of the move
     *
     * @return array $result the result of the move
     * @since 1.0
     */
    public function upgraderPostInstall(bool $true, mixed $hookExtra, array $result): array {
        global $wp_filesystem;

        // Move & Activate
        $proper_destination = \WP_PLUGIN_DIR . '/' . $this->config['proper_folder_name'];
        $wp_filesystem->move($result['destination'], $proper_destination);
        $result['destination'] = $proper_destination;
        $activate = activate_plugin(\WP_PLUGIN_DIR . '/' . $this->config['slug']);

        // Output the update message
        $fail = __(
			'The plugin has been updated, but could not be reactivated. Please reactivate it manually.',
			'pp-wp-basic-security'
        );
        $success = __('Plugin reactivated successfully.', 'pp-wp-basic-security');

        echo is_wp_error($activate) ? $fail : $success;

        return $result;
    }
}
