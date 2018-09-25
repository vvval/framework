<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Bootloader;

use Spiral\Config\ModifierInterface;
use Spiral\Config\Patch\AppendPatch;
use Spiral\Core\Bootloader\Bootloader;
use Spiral\Validation\ParserInterface;
use Spiral\Validation\RuleParser;
use Spiral\Validation\RulesInterface;
use Spiral\Validation\ValidationInterface;
use Spiral\Validation\ValidationProvider;

class ValidationBootloader extends Bootloader
{
    const BOOT = true;

    const SINGLETONS = [
        ValidationInterface::class => ValidationProvider::class,
        RulesInterface::class      => ValidationProvider::class,
        ParserInterface::class     => RuleParser::class
    ];

    /**
     * @param ModifierInterface $modifier
     *
     * @throws \Spiral\Core\Exception\ConfiguratorException
     */
    public function boot(ModifierInterface $modifier)
    {
        $modifier->modify('tokenizer', new AppendPatch(
            'directories',
            null,
            directory('vendor') . '/spiral/validation/src/'
        ));
    }
}