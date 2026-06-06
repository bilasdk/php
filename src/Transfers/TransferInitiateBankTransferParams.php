<?php

declare(strict_types=1);

namespace Bila\Transfers;

use Bila\Core\Attributes\Optional;
use Bila\Core\Attributes\Required;
use Bila\Core\Concerns\SdkModel;
use Bila\Core\Concerns\SdkParams;
use Bila\Core\Contracts\BaseModel;
use Bila\Transfers\TransferInitiateBankTransferParams\Country;

/**
 * Initiate a transfer to a bank account. Creates a transaction record in your dashboard.
 *
 * @see Bila\Services\TransfersService::initiateBankTransfer()
 *
 * @phpstan-type TransferInitiateBankTransferParamsShape = array{
 *   accountID: string,
 *   amount: float,
 *   reference: string,
 *   accountNumber?: string|null,
 *   bankID?: string|null,
 *   country?: null|Country|value-of<Country>,
 *   narration?: string|null,
 *   recipientName?: string|null,
 *   transferRecipientID?: string|null,
 *   walletID?: string|null,
 * }
 */
final class TransferInitiateBankTransferParams implements BaseModel
{
    /** @use SdkModel<TransferInitiateBankTransferParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Source account UUID.
     */
    #[Required('accountId')]
    public string $accountID;

    /**
     * Transfer amount.
     */
    #[Required]
    public float $amount;

    /**
     * Unique client reference (alphanumeric, dots, underscores, hyphens).
     */
    #[Required]
    public string $reference;

    /**
     * Bank account number (required if no transferRecipientId).
     */
    #[Optional]
    public ?string $accountNumber;

    /**
     * Bank ID (required if no transferRecipientId).
     */
    #[Optional('bankId')]
    public ?string $bankID;

    /**
     * Country code.
     *
     * @var value-of<Country>|null $country
     */
    #[Optional(enum: Country::class)]
    public ?string $country;

    /**
     * Transfer narration.
     */
    #[Optional]
    public ?string $narration;

    /**
     * Recipient name for the transaction record.
     */
    #[Optional]
    public ?string $recipientName;

    /**
     * Transfer recipient UUID (use this OR accountNumber+bankId).
     */
    #[Optional('transferRecipientId')]
    public ?string $transferRecipientID;

    /**
     * Source wallet ID to debit (optional, uses main wallet if not specified).
     */
    #[Optional('walletId')]
    public ?string $walletID;

    /**
     * `new TransferInitiateBankTransferParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TransferInitiateBankTransferParams::with(
     *   accountID: ..., amount: ..., reference: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TransferInitiateBankTransferParams)
     *   ->withAccountID(...)
     *   ->withAmount(...)
     *   ->withReference(...)
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
        string $accountID,
        float $amount,
        string $reference,
        ?string $accountNumber = null,
        ?string $bankID = null,
        Country|string|null $country = null,
        ?string $narration = null,
        ?string $recipientName = null,
        ?string $transferRecipientID = null,
        ?string $walletID = null,
    ): self {
        $self = new self;

        $self['accountID'] = $accountID;
        $self['amount'] = $amount;
        $self['reference'] = $reference;

        null !== $accountNumber && $self['accountNumber'] = $accountNumber;
        null !== $bankID && $self['bankID'] = $bankID;
        null !== $country && $self['country'] = $country;
        null !== $narration && $self['narration'] = $narration;
        null !== $recipientName && $self['recipientName'] = $recipientName;
        null !== $transferRecipientID && $self['transferRecipientID'] = $transferRecipientID;
        null !== $walletID && $self['walletID'] = $walletID;

        return $self;
    }

    /**
     * Source account UUID.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * Transfer amount.
     */
    public function withAmount(float $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * Unique client reference (alphanumeric, dots, underscores, hyphens).
     */
    public function withReference(string $reference): self
    {
        $self = clone $this;
        $self['reference'] = $reference;

        return $self;
    }

    /**
     * Bank account number (required if no transferRecipientId).
     */
    public function withAccountNumber(string $accountNumber): self
    {
        $self = clone $this;
        $self['accountNumber'] = $accountNumber;

        return $self;
    }

    /**
     * Bank ID (required if no transferRecipientId).
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

    /**
     * Transfer narration.
     */
    public function withNarration(string $narration): self
    {
        $self = clone $this;
        $self['narration'] = $narration;

        return $self;
    }

    /**
     * Recipient name for the transaction record.
     */
    public function withRecipientName(string $recipientName): self
    {
        $self = clone $this;
        $self['recipientName'] = $recipientName;

        return $self;
    }

    /**
     * Transfer recipient UUID (use this OR accountNumber+bankId).
     */
    public function withTransferRecipientID(string $transferRecipientID): self
    {
        $self = clone $this;
        $self['transferRecipientID'] = $transferRecipientID;

        return $self;
    }

    /**
     * Source wallet ID to debit (optional, uses main wallet if not specified).
     */
    public function withWalletID(string $walletID): self
    {
        $self = clone $this;
        $self['walletID'] = $walletID;

        return $self;
    }
}
