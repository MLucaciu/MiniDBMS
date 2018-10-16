<?php
/**
 * Created by PhpStorm.
 * User: Mircea
 * Date: 10/16/2018
 * Time: 7:33 PM
 */

namespace MiniDBMS\Model\Domain;


class IndexFile
{
    /** @var string */
    private $indexName;
    /** @var string */
    private $keyLength;
    /** @var string */
    private $isUnique;
    /** @var string */
    private $indexType;
    /** @var array of Attributes */
    private $indexAttributes;

    /**
     * IndexFile constructor.
     * @param string $indexName
     * @param string $keyLength
     * @param string $isUnique
     * @param string $indexType
     * @param array $indexAttributes
     */
    public function __construct(string $indexName, string $keyLength, string $isUnique, string $indexType, array $indexAttributes)
    {
        $this->indexName = $indexName;
        $this->keyLength = $keyLength;
        $this->isUnique = $isUnique;
        $this->indexType = $indexType;
        $this->indexAttributes = $indexAttributes;
    }

}