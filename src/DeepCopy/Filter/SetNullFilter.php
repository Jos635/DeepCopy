<?php

namespace DeepCopy\Filter;

use ReflectionProperty;

/**
 * Set a null value for a property
 */
class SetNullFilter implements Filter
{
    /**
     * {@inheritdoc}
     */
    public function apply($object, $property, $objectCopier)
    {
        $class = new \ReflectionClass(get_class($object));

        while(!$class->hasProperty($property))
        {
            // Try parent class
            $class = $class->getParentClass();
        }

        $reflectionProperty = $class->getProperty($property);//new ReflectionProperty($object, $property);

        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($object, null);
    }
}
