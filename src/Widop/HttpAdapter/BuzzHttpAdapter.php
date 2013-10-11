<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\HttpAdapter;

use Buzz\Browser;

/**
 * Buzz Http adapter.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class BuzzHttpAdapter implements HttpAdapterInterface
{
    /** @var \Buzz\Browser */
    private $browser;

    /**
     * Constructor.
     *
     * @param \Buzz\Browser $browser The buzz browser.
     */
    public function __construct(Browser $browser = null)
    {
        if ($browser === null) {
            $browser = new Browser();
        }

        $this->browser = $browser;
    }

    /**
     * {@inheritdoc}
     */
    public function getContent($url, array $headers = array())
    {
        try {
            return $this->browser->get($url, $headers)->getContent();
        } catch (\Exception $e) {
            throw HttpAdapterException::cannotFetchUrl($url, $this->getName(), $e->getMessage());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function postContent($url, array $headers = array(), $content = '')
    {
        try {
            return $this->browser->post($url, $headers, $content)->getContent();
        } catch (\Exception $e) {
            throw HttpAdapterException::cannotFetchUrl($url, $this->getName(), $e->getMessage());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'buzz';
    }
}
