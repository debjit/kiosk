# Open Kiosk
Laravel + React + Intertia + PgVector + PgSql

### We use pgvector; Postgres does the math; PHP only orchestrates.

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

## Configuration

### Confidence Scores

The jewelry recommendation system uses confidence scores to determine how well products match customer preferences. Confidence scores are stored as integers ranging from 1-100 (percentage-like scale).

**Database Storage:**
- **Type**: Integer
- **Range**: 1-100
- **Default**: 50 (medium confidence)

**Usage in Calculations:**
- Divide by 100.0 to normalize to 0.0-1.0 range for algorithm calculations
- Higher values (closer to 100) indicate stronger confidence in the match
- Lower values (closer to 1) indicate weaker confidence

**Example:**
```php
// In recommendation algorithm
$normalizedScore = $confidenceScore / 100.0; // Converts 50 → 0.5
$finalScore = ($similarityScore * 0.6) + ($normalizedScore * 0.3);
```

**Admin Interface:**
- Set confidence scores when tagging products (1-100 range)
- Visual percentage-like scale for better user understanding
- Default value of 50 for new product-tag associations

## ⚠️ **Important Development Guidelines**

### Database Operations
- **NEVER run migrations without explicit user permission**
- Always ask for confirmation before executing `php artisan migrate`
- Create migrations for schema changes, but wait for approval before running them
- Document any data transformations that will occur during migrations
- When modifying existing data, always provide rollback strategies

### Code Quality
- Run `composer lint` before committing changes
- Ensure all tests pass with `composer test`
- Follow Laravel and project-specific coding standards
- Use proper type hints and return types for all methods
