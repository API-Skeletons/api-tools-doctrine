<?php

/**
 * @see       https://github.com/laminas-api-tools/api-tools-doctrine for the canonical source repository
 * @copyright https://github.com/laminas-api-tools/api-tools-doctrine/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas-api-tools/api-tools-doctrine/blob/master/LICENSE.md New BSD License
 */

namespace Laminas\ApiTools\Doctrine\Admin\Model;

use Doctrine\Persistence\ObjectManager;
use Laminas\ApiTools\Admin\Model\RestServiceEntity;
use Laminas\Stdlib\ArraySerializableInterface;

class DoctrineRestServiceEntity extends RestServiceEntity implements ArraySerializableInterface
{
    /**
     * @var string
     */
    protected $hydratorName;

    /**
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * @var bool
     */
    protected $byValue = true;

    /**
     * @var array
     */
    protected $hydratorStrategies = [];

    /**
     * @var bool
     */
    protected $useGeneratedHydrator = true;

    public function exchangeArray(array $data)
    {
        parent::exchangeArray($data);

        foreach ($data as $key => $value) {
            $key = strtolower($key);
            $key = str_replace('_', '', $key);
            switch ($key) {
                case 'hydrator':
                    $this->hydratorName = $value;
                    break;
                case 'objectmanager':
                    $this->objectManager = $value;
                    break;
                case 'byvalue':
                    $this->byValue = $value;
                    break;
                case 'strategies':
                    $this->hydratorStrategies = $value;
                    break;
                case 'usegeneratedhydrator':
                    $this->useGeneratedHydrator = $value;
                    break;
            }
        }
    }

    public function getArrayCopy()
    {
        $data = parent::getArrayCopy();
        $data['hydrator_name']          = $this->hydratorName;
        $data['object_manager']         = $this->objectManager;
        $data['by_value']               = $this->byValue;
        $data['strategies']             = $this->hydratorStrategies;
        $data['use_generated_hydrator'] = $this->useGeneratedHydrator;

        return $data;
    }
}
