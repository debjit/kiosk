<?php

declare(strict_types=1);

namespace App\Models;

// Temporary backwards-compat proxy for old name if referenced anywhere.
// Will be fully removed once all usages are updated to QuestionOption.

final class SurveyOption extends QuestionOption {}
