<?php

declare(strict_types=1);

namespace Bila\Collections;

use Bila\Core\Attributes\Required;
use Bila\Core\Concerns\SdkModel;
use Bila\Core\Contracts\BaseModel;

/**
 * @phpstan-type BilaCollectionCustomerDtoShape = array{
 *   name: string, operator: string, phone: string
 * }
 */
final class BilaCollectionCustomerDto implements BaseModel
{
    /** @use SdkModel<BilaCollectionCustomerDtoShape> */
    use SdkModel;

    /**
     * Customer name.
     */
    #[Required]
    public string $name;

    /**
     * Mobile money operator.
     */
    #[Required]
    public string $operator;

    /**
     * Customer phone number.
     */
    #[Required]
    public string $phone;

    /**
     * `new BilaCollectionCustomerDto()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BilaCollectionCustomerDto::with(name: ..., operator: ..., phone: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BilaCollectionCustomerDto)
     *   ->withName(...)
     *   ->withOperator(...)
     *   ->withPhone(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        string $name,
        string $operator,
        string $phone
    ): self {
        $self = new self;

        $self['name'] = $name;
        $self['operator'] = $operator;
        $self['phone'] = $phone;

        return $self;
    }

    /**
     * Customer name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Mobile money operator.
     */
    public function withOperator(string $operator): self
    {
        $self = clone $this;
        $self['operator'] = $operator;

        return $self;
    }

    /**
     * Customer phone number.
     */
    public function withPhone(string $phone): self
    {
        $self = clone $this;
        $self['phone'] = $phone;

        return $self;
    }
}
