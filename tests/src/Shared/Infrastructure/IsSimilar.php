<?php

namespace App\Tests\src\Shared\Infrastructure;

use PHPUnit\Framework\Constraint\Constraint;

class IsSimilar extends Constraint
{
    private $expectedObject;
    private $excludedAttributes;
    private $differentField;

    /**
     * Comprova si l'objecte proporcionat coincideix amb l'objecte esperat, exclòs els atributs especificats.
     * Aquesta restricció s'utilitza per verificar si un objecte que s'està desant és similar a l'objecte esperat.
     */
    public function __construct($expectedObject, array $excludedAttributes)
    {
        $this->expectedObject = $expectedObject;
        $this->excludedAttributes = $excludedAttributes;
    }

    protected function matches($other): bool
    {
        if (!($other instanceof $this->expectedObject)) {
            return false;
        }

        $reflection = new \ReflectionClass($this->expectedObject);
        foreach ($reflection->getProperties() as $property) {
            $propertyName = $property->getName();
            if (!in_array($propertyName, $this->excludedAttributes, true)) {
                $property->setAccessible(true);
                $expectedValue = $property->getValue($this->expectedObject);
                $otherValue = $property->getValue($other);

                if ($expectedValue != $otherValue) {
                    $this->differentField = $propertyName;
                    return false;
                }
            }
        }

        return true;
    }

    protected function failureDescription($other): string
    {
        return sprintf(
            'two objects are equal excluding specified attributes, but the field "%s" was different',
            $this->differentField
        );
    }

    public function toString(): string
    {
        return sprintf(
            'two objects are equal excluding specified attributes, but the field "%s" was different',
            $this->differentField
        );
    }
}
