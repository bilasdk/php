<?php

declare(strict_types=1);

namespace Bila\Banks;

use Bila\Core\Attributes\Optional;
use Bila\Core\Concerns\SdkModel;
use Bila\Core\Concerns\SdkParams;
use Bila\Core\Contracts\BaseModel;

/**
 * Retrieve a list of all supported banks and financial institutions.
 *
 * @see Bila\Services\BanksService::list()
 *
 * @phpstan-type BankListParamsShape = array{country?: string|null}
 */
final class BankListParams implements BaseModel
{
    /** @use SdkModel<BankListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter banks by country code.
     */
    #[Optional]
    public ?string $country;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $country = null): self
    {
        $self = new self;

        null !== $country && $self['country'] = $country;

        return $self;
    }

    /**
     * Filter banks by country code.
     */
    public function withCountry(string $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }
}
