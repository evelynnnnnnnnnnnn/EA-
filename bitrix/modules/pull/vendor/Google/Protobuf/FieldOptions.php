<?php
/**
 * Generated by Protobuf protoc plugin.
 *
 * File descriptor : descriptor.proto
 */


namespace google\protobuf;

/**
 * Protobuf message : google.protobuf.FieldOptions
 */
class FieldOptions extends \Protobuf\AbstractMessage
{

    /**
     * @var \Protobuf\UnknownFieldSet
     */
    protected $unknownFieldSet = null;

    /**
     * @var \Protobuf\Extension\ExtensionFieldMap
     */
    protected $extensions = null;

    /**
     * ctype optional enum = 1
     *
     * @var \google\protobuf\FieldOptions\CType
     */
    protected $ctype = null;

    /**
     * packed optional bool = 2
     *
     * @var bool
     */
    protected $packed = null;

    /**
     * jstype optional enum = 6
     *
     * @var \google\protobuf\FieldOptions\JSType
     */
    protected $jstype = null;

    /**
     * lazy optional bool = 5
     *
     * @var bool
     */
    protected $lazy = null;

    /**
     * deprecated optional bool = 3
     *
     * @var bool
     */
    protected $deprecated = null;

    /**
     * weak optional bool = 10
     *
     * @var bool
     */
    protected $weak = null;

    /**
     * uninterpreted_option repeated message = 999
     *
     * @var \Protobuf\Collection<\google\protobuf\UninterpretedOption>
     */
    protected $uninterpreted_option = null;

    /**
     * {@inheritdoc}
     */
    public function __construct($stream = null, \Protobuf\Configuration $configuration = null)
    {
        $this->ctype = \google\protobuf\FieldOptions\CType::STRING();
        $this->jstype = \google\protobuf\FieldOptions\JSType::JS_NORMAL();
        $this->lazy = false;
        $this->deprecated = false;
        $this->weak = false;

        parent::__construct($stream, $configuration);
    }

    /**
     * Check if 'ctype' has a value
     *
     * @return bool
     */
    public function hasCtype()
    {
        return $this->ctype !== null;
    }

    /**
     * Get 'ctype' value
     *
     * @return \google\protobuf\FieldOptions\CType
     */
    public function getCtype()
    {
        return $this->ctype;
    }

    /**
     * Set 'ctype' value
     *
     * @param \google\protobuf\FieldOptions\CType $value
     */
    public function setCtype(\google\protobuf\FieldOptions\CType $value = null)
    {
        $this->ctype = $value;
    }

    /**
     * Check if 'packed' has a value
     *
     * @return bool
     */
    public function hasPacked()
    {
        return $this->packed !== null;
    }

    /**
     * Get 'packed' value
     *
     * @return bool
     */
    public function getPacked()
    {
        return $this->packed;
    }

    /**
     * Set 'packed' value
     *
     * @param bool $value
     */
    public function setPacked($value = null)
    {
        $this->packed = $value;
    }

    /**
     * Check if 'jstype' has a value
     *
     * @return bool
     */
    public function hasJstype()
    {
        return $this->jstype !== null;
    }

    /**
     * Get 'jstype' value
     *
     * @return \google\protobuf\FieldOptions\JSType
     */
    public function getJstype()
    {
        return $this->jstype;
    }

    /**
     * Set 'jstype' value
     *
     * @param \google\protobuf\FieldOptions\JSType $value
     */
    public function setJstype(\google\protobuf\FieldOptions\JSType $value = null)
    {
        $this->jstype = $value;
    }

    /**
     * Check if 'lazy' has a value
     *
     * @return bool
     */
    public function hasLazy()
    {
        return $this->lazy !== null;
    }

    /**
     * Get 'lazy' value
     *
     * @return bool
     */
    public function getLazy()
    {
        return $this->lazy;
    }

    /**
     * Set 'lazy' value
     *
     * @param bool $value
     */
    public function setLazy($value = null)
    {
        $this->lazy = $value;
    }

    /**
     * Check if 'deprecated' has a value
     *
     * @return bool
     */
    public function hasDeprecated()
    {
        return $this->deprecated !== null;
    }

    /**
     * Get 'deprecated' value
     *
     * @return bool
     */
    public function getDeprecated()
    {
        return $this->deprecated;
    }

    /**
     * Set 'deprecated' value
     *
     * @param bool $value
     */
    public function setDeprecated($value = null)
    {
        $this->deprecated = $value;
    }

    /**
     * Check if 'weak' has a value
     *
     * @return bool
     */
    public function hasWeak()
    {
        return $this->weak !== null;
    }

    /**
     * Get 'weak' value
     *
     * @return bool
     */
    public function getWeak()
    {
        return $this->weak;
    }

    /**
     * Set 'weak' value
     *
     * @param bool $value
     */
    public function setWeak($value = null)
    {
        $this->weak = $value;
    }

    /**
     * Check if 'uninterpreted_option' has a value
     *
     * @return bool
     */
    public function hasUninterpretedOptionList()
    {
        return $this->uninterpreted_option !== null;
    }

    /**
     * Get 'uninterpreted_option' value
     *
     * @return \Protobuf\Collection<\google\protobuf\UninterpretedOption>
     */
    public function getUninterpretedOptionList()
    {
        return $this->uninterpreted_option;
    }

    /**
     * Set 'uninterpreted_option' value
     *
     * @param \Protobuf\Collection<\google\protobuf\UninterpretedOption> $value
     */
    public function setUninterpretedOptionList(\Protobuf\Collection $value = null)
    {
        $this->uninterpreted_option = $value;
    }

    /**
     * Add a new element to 'uninterpreted_option'
     *
     * @param \google\protobuf\UninterpretedOption $value
     */
    public function addUninterpretedOption(\google\protobuf\UninterpretedOption $value)
    {
        if ($this->uninterpreted_option === null) {
            $this->uninterpreted_option = new \Protobuf\MessageCollection();
        }

        $this->uninterpreted_option->add($value);
    }

    /**
     * {@inheritdoc}
     */
    public function extensions()
    {
        if ( $this->extensions !== null) {
            return $this->extensions;
        }

        return $this->extensions = new \Protobuf\Extension\ExtensionFieldMap(__CLASS__);
    }

    /**
     * {@inheritdoc}
     */
    public function unknownFieldSet()
    {
        return $this->unknownFieldSet;
    }

    /**
     * {@inheritdoc}
     */
    public static function fromStream($stream, \Protobuf\Configuration $configuration = null)
    {
        return new self($stream, $configuration);
    }

    /**
     * {@inheritdoc}
     */
    public static function fromArray(array $values)
    {
        $message = new self();
        $values  = array_merge([
            'ctype' => \google\protobuf\FieldOptions\CType::STRING(),
            'packed' => null,
            'jstype' => \google\protobuf\FieldOptions\JSType::JS_NORMAL(),
            'lazy' => false,
            'deprecated' => false,
            'weak' => false,
            'uninterpreted_option' => []
        ], $values);

        $message->setCtype($values['ctype']);
        $message->setPacked($values['packed']);
        $message->setJstype($values['jstype']);
        $message->setLazy($values['lazy']);
        $message->setDeprecated($values['deprecated']);
        $message->setWeak($values['weak']);

        foreach ($values['uninterpreted_option'] as $item) {
            $message->addUninterpretedOption($item);
        }

        return $message;
    }

    /**
     * {@inheritdoc}
     */
    public static function descriptor()
    {
        return \google\protobuf\DescriptorProto::fromArray([
            'name'      => 'FieldOptions',
            'field'     => [
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 1,
                    'name' => 'ctype',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_ENUM(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL(),
                    'type_name' => '.google.protobuf.FieldOptions.CType',
                    'default_value' => \google\protobuf\FieldOptions\CType::STRING()
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 2,
                    'name' => 'packed',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_BOOL(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL()
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 6,
                    'name' => 'jstype',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_ENUM(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL(),
                    'type_name' => '.google.protobuf.FieldOptions.JSType',
                    'default_value' => \google\protobuf\FieldOptions\JSType::JS_NORMAL()
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 5,
                    'name' => 'lazy',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_BOOL(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL(),
                    'default_value' => false
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 3,
                    'name' => 'deprecated',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_BOOL(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL(),
                    'default_value' => false
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 10,
                    'name' => 'weak',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_BOOL(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL(),
                    'default_value' => false
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 999,
                    'name' => 'uninterpreted_option',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_MESSAGE(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_REPEATED(),
                    'type_name' => '.google.protobuf.UninterpretedOption'
                ]),
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function toStream(\Protobuf\Configuration $configuration = null)
    {
        $config  = $configuration ?: \Protobuf\Configuration::getInstance();
        $context = $config->createWriteContext();
        $stream  = $context->getStream();

        $this->writeTo($context);
        $stream->seek(0);

        return $stream;
    }

    /**
     * {@inheritdoc}
     */
    public function writeTo(\Protobuf\WriteContext $context)
    {
        $stream      = $context->getStream();
        $writer      = $context->getWriter();
        $sizeContext = $context->getComputeSizeContext();

        if ($this->ctype !== null) {
            $writer->writeVarint($stream, 8);
            $writer->writeVarint($stream, $this->ctype->value());
        }

        if ($this->packed !== null) {
            $writer->writeVarint($stream, 16);
            $writer->writeBool($stream, $this->packed);
        }

        if ($this->jstype !== null) {
            $writer->writeVarint($stream, 48);
            $writer->writeVarint($stream, $this->jstype->value());
        }

        if ($this->lazy !== null) {
            $writer->writeVarint($stream, 40);
            $writer->writeBool($stream, $this->lazy);
        }

        if ($this->deprecated !== null) {
            $writer->writeVarint($stream, 24);
            $writer->writeBool($stream, $this->deprecated);
        }

        if ($this->weak !== null) {
            $writer->writeVarint($stream, 80);
            $writer->writeBool($stream, $this->weak);
        }

        if ($this->uninterpreted_option !== null) {
            foreach ($this->uninterpreted_option as $val) {
                $writer->writeVarint($stream, 7994);
                $writer->writeVarint($stream, $val->serializedSize($sizeContext));
                $val->writeTo($context);
            }
        }

        if ($this->extensions !== null) {
            $this->extensions->writeTo($context);
        }

        return $stream;
    }

    /**
     * {@inheritdoc}
     */
    public function readFrom(\Protobuf\ReadContext $context)
    {
        $reader = $context->getReader();
        $length = $context->getLength();
        $stream = $context->getStream();

        $limit = ($length !== null)
            ? ($stream->tell() + $length)
            : null;

        while ($limit === null || $stream->tell() < $limit) {

            if ($stream->eof()) {
                break;
            }

            $key  = $reader->readVarint($stream);
            $wire = \Protobuf\WireFormat::getTagWireType($key);
            $tag  = \Protobuf\WireFormat::getTagFieldNumber($key);

            if ($stream->eof()) {
                break;
            }

            if ($tag === 1) {
                \Protobuf\WireFormat::assertWireType($wire, 14);

                $this->ctype = \google\protobuf\FieldOptions\CType::valueOf($reader->readVarint($stream));

                continue;
            }

            if ($tag === 2) {
                \Protobuf\WireFormat::assertWireType($wire, 8);

                $this->packed = $reader->readBool($stream);

                continue;
            }

            if ($tag === 6) {
                \Protobuf\WireFormat::assertWireType($wire, 14);

                $this->jstype = \google\protobuf\FieldOptions\JSType::valueOf($reader->readVarint($stream));

                continue;
            }

            if ($tag === 5) {
                \Protobuf\WireFormat::assertWireType($wire, 8);

                $this->lazy = $reader->readBool($stream);

                continue;
            }

            if ($tag === 3) {
                \Protobuf\WireFormat::assertWireType($wire, 8);

                $this->deprecated = $reader->readBool($stream);

                continue;
            }

            if ($tag === 10) {
                \Protobuf\WireFormat::assertWireType($wire, 8);

                $this->weak = $reader->readBool($stream);

                continue;
            }

            if ($tag === 999) {
                \Protobuf\WireFormat::assertWireType($wire, 11);

                $innerSize    = $reader->readVarint($stream);
                $innerMessage = new \google\protobuf\UninterpretedOption();

                if ($this->uninterpreted_option === null) {
                    $this->uninterpreted_option = new \Protobuf\MessageCollection();
                }

                $this->uninterpreted_option->add($innerMessage);

                $context->setLength($innerSize);
                $innerMessage->readFrom($context);
                $context->setLength($length);

                continue;
            }

            $extensions = $context->getExtensionRegistry();
            $extension  = $extensions ? $extensions->findByNumber(__CLASS__, $tag) : null;

            if ($extension !== null) {
                $this->extensions()->add($extension, $extension->readFrom($context, $wire));

                continue;
            }

            if ($this->unknownFieldSet === null) {
                $this->unknownFieldSet = new \Protobuf\UnknownFieldSet();
            }

            $data    = $reader->readUnknown($stream, $wire);
            $unknown = new \Protobuf\Unknown($tag, $wire, $data);

            $this->unknownFieldSet->add($unknown);

        }
    }

    /**
     * {@inheritdoc}
     */
    public function serializedSize(\Protobuf\ComputeSizeContext $context)
    {
        $calculator = $context->getSizeCalculator();
        $size       = 0;

        if ($this->ctype !== null) {
            $size += 1;
            $size += $calculator->computeVarintSize($this->ctype->value());
        }

        if ($this->packed !== null) {
            $size += 1;
            $size += 1;
        }

        if ($this->jstype !== null) {
            $size += 1;
            $size += $calculator->computeVarintSize($this->jstype->value());
        }

        if ($this->lazy !== null) {
            $size += 1;
            $size += 1;
        }

        if ($this->deprecated !== null) {
            $size += 1;
            $size += 1;
        }

        if ($this->weak !== null) {
            $size += 1;
            $size += 1;
        }

        if ($this->uninterpreted_option !== null) {
            foreach ($this->uninterpreted_option as $val) {
                $innerSize = $val->serializedSize($context);

                $size += 2;
                $size += $innerSize;
                $size += $calculator->computeVarintSize($innerSize);
            }
        }

        if ($this->extensions !== null) {
            $size += $this->extensions->serializedSize($context);
        }

        return $size;
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        $this->ctype = \google\protobuf\FieldOptions\CType::STRING();
        $this->packed = null;
        $this->jstype = \google\protobuf\FieldOptions\JSType::JS_NORMAL();
        $this->lazy = false;
        $this->deprecated = false;
        $this->weak = false;
        $this->uninterpreted_option = null;
    }

    /**
     * {@inheritdoc}
     */
    public function merge(\Protobuf\Message $message)
    {
        if ( ! $message instanceof \google\protobuf\FieldOptions) {
            throw new \InvalidArgumentException(sprintf('Argument 1 passed to %s must be a %s, %s given', __METHOD__, __CLASS__, get_class($message)));
        }

        $this->ctype = ($message->ctype !== null) ? $message->ctype : $this->ctype;
        $this->packed = ($message->packed !== null) ? $message->packed : $this->packed;
        $this->jstype = ($message->jstype !== null) ? $message->jstype : $this->jstype;
        $this->lazy = ($message->lazy !== null) ? $message->lazy : $this->lazy;
        $this->deprecated = ($message->deprecated !== null) ? $message->deprecated : $this->deprecated;
        $this->weak = ($message->weak !== null) ? $message->weak : $this->weak;
        $this->uninterpreted_option = ($message->uninterpreted_option !== null) ? $message->uninterpreted_option : $this->uninterpreted_option;
    }


}
