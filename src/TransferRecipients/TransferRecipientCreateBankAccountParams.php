<?php

declare(strict_types=1);

namespace Bila\TransferRecipients;

use Bila\Core\Attributes\Optional;
use Bila\Core\Attributes\Required;
use Bila\Core\Concerns\SdkModel;
use Bila\Core\Concerns\SdkParams;
use Bila\Core\Contracts\BaseModel;
use Bila\TransferRecipients\TransferRecipientCreateBankAccountParams\Country;

/**
 * Create a new bank account transfer recipient.
 *
 * @see Bila\Services\TransferRecipientsService::createBankAccount()
 *
 * @phpstan-type TransferRecipientCreateBankAccountParamsShape = array{
 *   accountNumber: string,
 *   bankID: string,
 *   accountName?: string|null,
 *   country?: null|Country|value-of<Country>,
 * }
 */
final class TransferRecipientCreateBankAccountParams implements BaseModel
{
    /** @use SdkModel<TransferRecipientCreateBankAccountParamsShape> */
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
     * Account holder name (optional, will be resolved).
     */
    #[Optional]
    public ?string $accountName;

    /**
     * Country code.
     *
     * @var value-of<Country>|null $country
     */
    #[Optional(enum: Country::class)]
    public ?string $country;

    /**
     * `new TransferRecipientCreateBankAccountParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TransferRecipientCreateBankAccountParams::with(accountNumber: ..., bankID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TransferRecipientCreateBankAccountParams)
     *   ->withAccountNumber(...)
     *   ->withBankID(...)
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
        ?string $accountName = null,
        Country|string|null $country = null,
    ): self {
        $self = new self;

        $self['accountNumber'] = $accountNumber;
        $self['bankID'] = $bankID;

        null !== $accountName && $self['accountName'] = $accountName;
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
     * Account holder name (optional, will be resolved).
     */
    public function withAccountName(string $accountName): self
    {
        $self = clone $this;
        $self['accountName'] = $accountName;

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
