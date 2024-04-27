# Makefile for the WordPress plugin WordPress Memory Usage

# Default goal and help message for the Makefile
.DEFAULT_GOAL := help

wp_cli = /usr/local/bin/wp-cli
wp_path = ./../../../../WP-Sources

plugin_name = WordPress Basic Security
plugin_slug = pp-wp-basic-security

help:
	@echo "$(plugin_name) Makefile"
	@echo ""
	@echo "Usage: make [command]"
	@echo ""
	@echo "Commands:"
	@echo "  activate           Activate the plugin"
	@echo "  clear-transient    Clear all transient caches"
	@echo "  deactivate         Deactivate the plugin"
	@echo "  pot                Create the plugin .pot file"
	@echo "  pre-commit-checks  Run pre-commit checks"

activate:
	$(wp_cli) plugin activate \
		$(plugin_slug) \
		--path=$(wp_path)

deactivate:
	$(wp_cli) plugin deactivate \
		$(plugin_slug) \
		--path=$(wp_path)

pot:
	$(wp_cli) i18n make-pot \
		. \
		l10n/$(plugin_slug).pot \
		--slug=$(plugin_slug) \
		--domain=$(plugin_slug) \
		--include="/"

clear-transient:
	$(wp_cli) transient delete \
		--all \
		--path=$(wp_path)

pre-commit-checks:
	@echo "Running pre-commit checks"
	pre-commit run --all-files
