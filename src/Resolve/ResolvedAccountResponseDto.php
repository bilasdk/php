<?php

declare(strict_types=1);

namespace Bila\Resolve;

use Bila\Core\Attributes\Optional;
use Bila\Core\Attributes\Required;
use Bila\Core\Concerns\SdkModel;
use Bila\Core\Contracts\BaseModel;

/**
 * @phpstan-type ResolvedAccountResponseDtoShape = array{
 *   accountName: string,
 *   country: string,
 *   accountNumber?: string|null,
 *   bankID?: string|null,
 *   bankName?: string|null,
 *   operator?: string|null,
 *   phone?: string|null,
 * }
 */
final class ResolvedAccountResponseDto implements BaseModel
{
    /** @use SdkModel<ResolvedAccountResponseDtoShape> */
    use SdkModel;

    /**
     * Account holder name.
     */
    #[Required]
    public string $accountName;

    /**
     * Country code.
     */
    #[Required]
    public string $country;

    /**
     * Bank account number.
     */
    #[Optional]
    public ?string $accountNumber;

    /**
     * Bank ID.
     */
    #[Optional('bankId')]
    public ?string $bankID;

    /**
     * Bank name.
     */
    #[Optional]
    public ?string $bankName;

    /**
     * Mobile money operator.
     */
    #[Optional]
    public ?string $operator;

    /**
     * Phone number.
     */
    #[Optional]
    public ?string $phone;

    /**
     * `new ResolvedAccountResponseDto()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ResolvedAccountResponseDto::with(accountName: ..., country: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ResolvedAccountResponseDto)->withAccountName(...)->withCountry(...)
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
        string $accountName,
        string $country,
        ?string $accountNumber = null,
        ?string $bankID = null,
        ?string $bankName = null,
        ?string $operator = null,
        ?string $phone = null,
    ): self {
        $self = new self;

        $self['accountName'] = $accountName;
        $self['country'] = $country;

        null !== $accountNumber && $self['accountNumber'] = $accountNumber;
        null !== $bankID && $self['bankID'] = $bankID;
        null !== $bankName && $self['bankName'] = $bankName;
        null !== $operator && $self['operator'] = $operator;
        null !== $phone && $self['phone'] = $phone;

        return $self;
    }

    /**
     * Account holder name.
     */
    public function withAccountName(string $accountName): self
    {
        $self = clone $this;
        $self['accountName'] = $accountName;

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
     * Bank name.
     */
    public function withBankName(string $bankName): self
    {
        $self = clone $this;
        $self['bankName'] = $bankName;

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
     * Phone number.
     */
    public function withPhone(string $phone): self
    {
        $self = clone $this;
        $self['phone'] = $phone;

        return $self;
    }
}
