# Run pre-commit checks
pre-commit-checks:
	@echo "Running pre-commit checks …"
	@pre-commit run --all-files

# Update pre-commit configuration
.PHONY: pre-commit-update
pre-commit-update:
	@echo "Updating pre-commit configuration …"
	@pre-commit autoupdate

# Help message for the Pre-Commit commands
.PHONY: help
help::
	@echo "  $(TEXT_UNDERLINE)pre-commit:$(TEXT_UNDERLINE_END)"
	@echo "    pre-commit-checks         Run pre-commit checks"
	@echo "    pre-commit-update         Update pre-commit configuration"
	@echo ""
