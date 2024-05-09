# Makefile for the WordPress plugin WordPress Memory Usage

# Default goal and help message for the Makefile
.DEFAULT_GOAL := help

# Variables for the WordPress CLI and the path to the WordPress installation
wp_cli = vendor/bin/wp
wp_path = ./../../../../WP-Sources

# Plugin name and slug
plugin_name = WordPress Basic Security
plugin_slug = pp-wp-basic-security

# Help message for the Makefile
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
	@echo "  pre-commit-update  Update pre-commit configuration"

# Activate the plugin
activate:
	@$(wp_cli) plugin activate \
		$(plugin_slug) \
		--path=$(wp_path)

# Deactivate the plugin
deactivate:
	@$(wp_cli) plugin deactivate \
		$(plugin_slug) \
		--path=$(wp_path)

# Create the plugin .pot file
pot:
	@$(wp_cli) i18n make-pot \
		. \
		l10n/$(plugin_slug).pot \
		--slug=$(plugin_slug) \
		--domain=$(plugin_slug) \
		--include="/"

# Clear transient caches
clear-transient:
	@$(wp_cli) transient delete \
		--all \
		--path=$(wp_path)

# Run pre-commit checks
pre-commit-checks:
	@echo "Running pre-commit checks"
	@pre-commit run --all-files

# Update pre-commit configuration
pre-commit-update:
	@echo "Updating pre-commit configuration"
	@pre-commit autoupdate
