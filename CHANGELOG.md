# Changelog

All notable changes to `marekskopal/router` are documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added
- Support for `league/route` 7.0; the constraint now allows `^6.2 || ^7.0`.
- CI workflow (PHPStan, PHPCS, PHPUnit) with a matrix covering PHP 8.3/8.4 and highest/lowest dependency versions.
- `.gitattributes` to exclude development files from distribution archives.

### Fixed
- Homepage link in `composer.json`.

## [1.2.0] - 2026-03-10

### Added
- Support for registering routes from multiple class directories.

### Changed
- Raised PHPStan to the maximum analysis level.
- Updated Composer dependencies.

## [1.1.0] - 2024-11-18

### Changed
- Upgraded to `league/route` `^6.0`.
- Updated PHPStan configuration.

### Fixed
- Route handler call resolution.
- `missingType.generics` PHPStan error.

## [1.0.1] - 2024-04-06

### Fixed
- Token count variable handling in the class scanner.

## [1.0.0] - 2024-04-06

### Added
- Initial release: PHP 8 attribute-based route registration on top of `league/route`.
- `Route` attribute plus per-method convenience attributes (`RouteGet`, `RoutePost`, `RoutePut`, `RouteDelete`, `RoutePatch`, `RouteHead`, `RouteOptions`) for all HTTP methods.
- Route attribute discovery on both classes and methods.
- Route caching via a PSR-16 `CacheInterface`.

[Unreleased]: https://github.com/marekskopal/router/compare/v1.2.0...HEAD
[1.2.0]: https://github.com/marekskopal/router/compare/v1.1.0...v1.2.0
[1.1.0]: https://github.com/marekskopal/router/compare/v1.0.1...v1.1.0
[1.0.1]: https://github.com/marekskopal/router/compare/v1.0.0...v1.0.1
[1.0.0]: https://github.com/marekskopal/router/releases/tag/v1.0.0
