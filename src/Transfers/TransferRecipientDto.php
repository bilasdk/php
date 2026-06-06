<?php

declare(strict_types=1);

namespace Bila\Transfers;

use Bila\Core\Attributes\Optional;
use Bila\Core\Attributes\Required;
use Bila\Core\Concerns\SdkModel;
use Bila\Core\Contracts\BaseModel;

/**
 * @phpstan-type TransferRecipientDtoShape = array{
 *   accountName: string,
 *   accountNumber?: string|null,
 *   bankName?: string|null,
 *   operator?: string|null,
 *   phone?: string|null,
 * }
 */
final class TransferRecipientDto implements BaseModel
{
    /** @use SdkModel<TransferRecipientDtoShape> */
    use SdkModel;

    /**
     * Account holder / recipient name.
     */
    #[Required]
    public string $accountName;

    /**
     * Bank account number (bank-account only).
     */
    #[Optional]
    public ?string $accountNumber;

    /**
     * Bank name (bank-account only).
     */
    #[Optional]
    public ?string $bankName;

    /**
     * Mobile money operator (mobile-money only).
     */
    #[Optional]
    public ?string $operator;

    /**
     * Phone number (mobile-money only).
     */
    #[Optional]
    public ?string $phone;

    /**
     * `new TransferRecipientDto()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TransferRecipientDto::with(accountName: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TransferRecipientDto)->withAccountName(...)
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
        ?string $accountNumber = null,
        ?string $bankName = null,
        ?string $operator = null,
        ?string $phone = null,
    ): self {
        $self = new self;

        $self['accountName'] = $accountName;

        null !== $accountNumber && $self['accountNumber'] = $accountNumber;
        null !== $bankName && $self['bankName'] = $bankName;
        null !== $operator && $self['operator'] = $operator;
        null !== $phone && $self['phone'] = $phone;

        return $self;
    }

    /**
     * Account holder / recipient name.
     */
    public function withAccountName(string $accountName): self
    {
        $self = clone $this;
        $self['accountName'] = $accountName;

        return $self;
    }

    /**
     * Bank account number (bank-account only).
     */
    public function withAccountNumber(string $accountNumber): self
    {
        $self = clone $this;
        $self['accountNumber'] = $accountNumber;

        return $self;
    }

    /**
     * Bank name (bank-account only).
     */
    public function withBankName(string $bankName): self
    {
        $self = clone $this;
        $self['bankName'] = $bankName;

        return $self;
    }

    /**
     * Mobile money operator (mobile-money only).
     */
    public function withOperator(string $operator): self
    {
        $self = clone $this;
        $self['operator'] = $operator;

        return $self;
    }

    /**
     * Phone number (mobile-money only).
     */
    public function withPhone(string $phone): self
    {
        $self = clone $this;
        $self['phone'] = $phone;

        return $self;
    }
}
