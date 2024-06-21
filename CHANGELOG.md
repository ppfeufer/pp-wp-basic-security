# Change Log

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

<!--
GitHub MD Syntax:
https://docs.github.com/en/get-started/writing-on-github/getting-started-with-writing-and-formatting-on-github/basic-writing-and-formatting-syntax

Highlighting:
https://docs.github.com/assets/cb-41128/mw-1440/images/help/writing/alerts-rendered.webp

> [!NOTE]
> Highlights information that users should take into account, even when skimming.

> [!IMPORTANT]
> Crucial information necessary for users to succeed.

> [!WARNING]
> Critical content demanding immediate user attention due to potential risks.
-->

## \[In Development\] – Unreleased

<!--
Section Order:

### Added
### Fixed
### Changed
### Deprecated
### Removed
### Security
-->

### Added

- Setting to enable/disable the various tweaks. (Disabled by default)

### Changed

- Put constants under our namespace to avoid potential conflicts

## \[1.2.0\] - 2024-04-14

### Added

- Argument names wherever possible

### Changed

- General code cleanup
- Autoloader refactored
- Switched to the composer version of the update checker

## \[1.1.2\] - 2023-10-03

### Changed

- Available translations updated

## \[1.1.1\] - 2023-09-15

### Fixed

- Namespace in Autoloader

## \[1.1.0\] - 2023-09-15

### Fixed

- Plugin namespace

## \[1.0.0\] - 2023-09-12

### Added

- New GitHub updater library for hopefully better results
- pre-commit checks
- GH workflows for pre-commit checks
- Minimum Requirements to README
  - WP 6.0
  - PHP 8.2

### Removed

- Old GitHub updater class
