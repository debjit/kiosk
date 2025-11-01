# Open Kiosk
Laravel + React + Intertia

## Homepage Previews

<div align="center">
  <img src="https://github.com/user-attachments/assets/8f5174b4-c465-40ae-9801-3cb29b065a12" alt="Alpana Gems Homepage View 1" width="200" style="margin: 5px; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"/>
  <img src="https://github.com/user-attachments/assets/f4244cb3-ac7d-4d09-9540-d24c3fed5e0c" alt="Alpana Gems Homepage View 2" width="200" style="margin: 5px; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);"/>
</div>

### Initial Setup

Navigate to your project and complete the setup:

```bash
cd example-app

# Setup the project
composer setup

# Start the development server
composer dev
```

### Optional: Browser Testing Setup

If you plan to use Pest's browser testing capabilities:

```bash
npm install playwright
npx playwright install
```

### Verify Installation

Run the test suite to ensure everything is configured correctly:

```bash
composer test
```

You should see 100% test coverage and all quality checks passing.

## Available Tooling

### Development
- `composer dev` - Starts Laravel server, queue worker, log monitoring, and Vite dev server concurrently

### Code Quality
- `composer lint` - Runs Rector (refactoring), Pint (PHP formatting), and Prettier (JS/TS formatting)
- `composer test:lint` - Dry-run mode for CI/CD pipelines

### Testing
- `composer test:type-coverage` - Ensures 100% type coverage with Pest
- `composer test:types` - Runs PHPStan at level 9 (maximum strictness)
- `composer test:unit` - Runs Pest tests with 100% code coverage requirement
- `composer test` - Runs the complete test suite (type coverage, unit tests, linting, static analysis)

### Maintenance
- `composer update:requirements` - Updates all PHP and NPM dependencies to latest versions
