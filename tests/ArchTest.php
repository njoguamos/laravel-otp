<?php

declare(strict_types=1);

arch(description: 'it will not use debugging functions')
    ->expect(value: ['dd', 'dump', 'ray'])
    ->each->not->toBeUsed();
