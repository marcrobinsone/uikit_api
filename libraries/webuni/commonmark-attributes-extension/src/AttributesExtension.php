<?php

/*
 * This is part of the webuni/commonmark-attributes-extension package.
 *
 * (c) Martin Hasoň <martin.hason@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Webuni\CommonMark\AttributesExtension;

use League\CommonMark\Extension\Extension;

class AttributesExtension extends Extension
{
    public function getBlockParsers()
    {
        return [
            new AttributesBlockParser(),
        ];
    }

    public function getInlineParsers()
    {
        return [
            new AttributesInlineParser(),
        ];
    }

    public function getInlineProcessors()
    {
        return [
            new AttributesInlineProcessor(),
        ];
    }

    public function getName()
    {
        return 'attributes';
    }
}
