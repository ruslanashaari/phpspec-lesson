<?php

/*
 * This file is part of PhpSpec, A php toolset to drive emergent
 * design by specification.
 *
 * (c) Marcello Duarte <marcello.duarte@gmail.com>
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PhpSpec\Matcher;

use PhpSpec\Formatter\Presenter\Presenter;
use PhpSpec\Exception\Example\FailureException;

final class StringRegexMatcher extends BasicMatcher
{
    /**
     * @var Presenter
     */
    private $presenter;

    /**
     * @param Presenter $presenter
     */
    public function __construct(Presenter $presenter)
    {
        $this->presenter = $presenter;
    }

    /**
     * @param string $name
     * @param mixed  $subject
     * @param array  $arguments
     *
     * @return bool
     */
    public function supports(string $name, $subject, array $arguments): bool
    {
        return 'match' === $name
            && is_string($subject)
            && 1 == count($arguments)
        ;
    }

    /**
     * @param mixed $subject
     * @param array $arguments
     *
     * @return bool
     */
    protected function matches($subject, array $arguments): bool
    {
        return (Boolean) preg_match($arguments[0], $subject);
    }

    /**
     * @param string $name
     * @param mixed  $subject
     * @param array  $arguments
     *
     * @return FailureException
     */
    protected function getFailureException(string $name, $subject, array $arguments): FailureException
    {
        return new FailureException(sprintf(
            'Expected %s to match %s regex, but it does not.',
            $this->presenter->presentString($subject),
            $this->presenter->presentString($arguments[0])
        ));
    }

    /**
     * @param string $name
     * @param mixed  $subject
     * @param array  $arguments
     *
     * @return FailureException
     */
    protected function getNegativeFailureException(string $name, $subject, array $arguments): FailureException
    {
        return new FailureException(sprintf(
            'Expected %s not to match %s regex, but it does.',
            $this->presenter->presentString($subject),
            $this->presenter->presentString($arguments[0])
        ));
    }
}