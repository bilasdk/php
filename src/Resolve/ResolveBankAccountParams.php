<?php

declare(strict_types=1);

namespace Bila\Resolve;

use Bila\Core\Attributes\Optional;
use Bila\Core\Attributes\Required;
use Bila\Core\Concerns\SdkModel;
use Bila\Core\Concerns\SdkParams;
use Bila\Core\Contracts\BaseModel;
use Bila\Resolve\ResolveBankAccountParams\Country;

/**
 * Verify and retrieve bank account holder details.
 *
 * @see Bila\Services\ResolveService::bankAccount()
 *
 * @phpstan-type ResolveBankAccountParamsShape = array{
 *   accountNumber: string,
 *   bankID: string,
 *   country?: null|Country|value-of<Country>,
 * }
 */
final class ResolveBankAccountParams implements BaseModel
{
    /** @use SdkModel<ResolveBankAccountParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Bank account number.
     */
    #[Required]
    public string $accountNumber;

    /**
     * Bank ID.
     */
    #[Required('bankId')]
    public string $bankID;

    /**
     * Country code.
     *
     * @var value-of<Country>|null $country
     */
    #[Optional(enum: Country::class)]
    public ?string $country;

    /**
     * `new ResolveBankAccountParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ResolveBankAccountParams::with(accountNumber: ..., bankID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ResolveBankAccountParams)->withAccountNumber(...)->withBankID(...)
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
     *
     * @param Country|value-of<Country>|null $country
     */
    public static function with(
        string $accountNumber,
        string $bankID,
        Country|string|null $country = null
    ): self {
        $self = new self;

        $self['accountNumber'] = $accountNumber;
        $self['bankID'] = $bankID;

        null !== $country && $self['country'] = $country;

        return $self;
    }

    /**
     * Bank account number.
     */
    public function withAccountNumber(string $accountNumber): self
    {
        $self = clone $this;
        $self['accountNumber'] = $accountNumber;

        return $self;
    }

    /**
     * Bank ID.
     */
    public function withBankID(string $bankID): self
    {
        $self = clone $this;
        $self['bankID'] = $bankID;

        return $self;
    }

    /**
     * Country code.
     *
     * @param Country|value-of<Country> $country
     */
    public function withCountry(Country|string $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }
}
