<?php

declare(strict_types=1);

namespace Bila\Banks\BankListResponse;

use Bila\Core\Attributes\Optional;
use Bila\Core\Attributes\Required;
use Bila\Core\Concerns\SdkModel;
use Bila\Core\Contracts\BaseModel;

/**
 * @phpstan-type DataShape = array{
 *   id: string, code: string, country: string, name: string, type?: string|null
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /**
     * Bank ID.
     */
    #[Required]
    public string $id;

    /**
     * Bank code.
     */
    #[Required]
    public string $code;

    /**
     * Country code.
     */
    #[Required]
    public string $country;

    /**
     * Bank name.
     */
    #[Required]
    public string $name;

    /**
     * Bank type.
     */
    #[Optional]
    public ?string $type;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(id: ..., code: ..., country: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Data)->withID(...)->withCode(...)->withCountry(...)->withName(...)
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
        string $id,
        string $code,
        string $country,
        string $name,
        ?string $type = null
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['code'] = $code;
        $self['country'] = $country;
        $self['name'] = $name;

        null !== $type && $self['type'] = $type;

        return $self;
    }

    /**
     * Bank ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Bank code.
     */
    public function withCode(string $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }

    /**
     * Country code.
     */
    public function withCountry(string $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }

    /**
     * Bank name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Bank type.
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
