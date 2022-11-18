<?php

declare(strict_types=1);

namespace Test\MyroStadler\ProtoWeb;

class Spy
{
    /** @var SpyCall[]  */
    protected $calls = [];

    protected $triggers = [];

    protected $returnValues = [];

    protected const KEY_RETURN_VALUE = 'returnValue';
    protected const KEY_REQUIRED_ARGS = 'requiredArguments';

    /**
     * Usage: one-liners in spy functions e.g. return $this->spy(__METHOD__, func_get_args()) ?? []
     * @param string $method
     * @param array $arguments
     * @return mixed|null
     */
    public function on(string $method, array $arguments)
    {
        $call = new SpyCall($method, $arguments);
        $this->calls[] = $call;
        if ($e = $this->triggers[$call->getMethod()] ?? null) {
            throw $e;
        }
        return $this->getReturnValueFor($call);
    }

    public function clearReturnValuesFor(string $method): self
    {
        unset($this->returnValues[$method]);
        return $this;
    }

    public function addReturnValueFor(string $method, $returnValue, array $requiredArguments = []): self
    {
        if (!array_key_exists($method, $this->returnValues)) {
            $this->returnValues[$method] = [];
        }
        $this->returnValues[$method][] = [
            self::KEY_RETURN_VALUE => $returnValue,
            self::KEY_REQUIRED_ARGS => $requiredArguments,
        ];
        return $this;
    }

    public function addTrigger(string $method, \Throwable $e): self
    {
        $this->triggers[$method] = $e;
        return $this;
    }

    /**
     * @param SpyCall $call
     * @return mixed|null
     */
    private function getReturnValueFor(SpyCall $call)
    {
        $returnValueCandidates = $this->returnValues[$call->getMethod()] ?? null;
        if (!$returnValueCandidates) {
            return null;
        }
        foreach ($returnValueCandidates as $candidate) {
            if (empty($candidate[self::KEY_REQUIRED_ARGS])) {
                return $candidate[self::KEY_RETURN_VALUE];
            }
            $callArgs = $call->getArguments();
            $argsMatch = true;
            foreach ($candidate[self::KEY_REQUIRED_ARGS] as $i => $requiredValue) {
                if (
                    !isset($callArgs[$i])
                    || $callArgs[$i] !== $requiredValue
                ) {
                    $argsMatch = false;
                    break;
                }
            }
            if ($argsMatch) {
                return $candidate[self::KEY_RETURN_VALUE];
            }
        }
        return null;
    }

    public function findCallsMatching(SpyCall $callToMatch): array
    {
        $found = [];
        foreach ($this->calls as $call) {
            $methodMatches = true;
            if ($methodToMatch = $callToMatch->getMethod()) {
                if ($methodToMatch !== $call->getMethod()) {
                    $methodMatches = false;
                }
            }
            $argsMatch = true;
            if ($argsToMatch = $callToMatch->getArguments()) {
                $args = $call->getArguments();
                foreach ($argsToMatch as $i => $value) {
                    if (
                        !isset($args[$i])
                        || $args[$i] !== $value
                    ) {
                        $argsMatch = false;
                        break;
                    }
                }
            }
            if ($methodMatches && $argsMatch) {
                $found[] = $call;
            }
        }
        return $found;
    }
}
