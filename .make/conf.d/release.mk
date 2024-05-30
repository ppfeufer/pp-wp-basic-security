# Create a new release archive
release-archive:
	@echo "Creating a new release archive …"
	@rm -f $(plugin_slug).zip
	@rm -rf $(plugin_slug)/
	@rsync \
		-ax \
		--exclude-from=.make/rsync-exclude.lst \
		. \
		$(plugin_slug)/
	@zip \
		-r \
		$(plugin_slug).zip \
		$(plugin_slug)/
	@rm -rf $(plugin_slug)/

help::
	@echo "  $(TEXT_UNDERLINE)Release:$(TEXT_UNDERLINE_END)"
	@echo "    release-archive           Create a release archive."
	@echo "                              The release archive ($(plugin_slug).zip) will be created in the root"
	@echo "                              directory of the plugin."
	@echo ""
