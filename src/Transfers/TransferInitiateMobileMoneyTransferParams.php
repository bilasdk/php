<?php

declare(strict_types=1);

namespace Bila\Transfers;

use Bila\Core\Attributes\Optional;
use Bila\Core\Attributes\Required;
use Bila\Core\Concerns\SdkModel;
use Bila\Core\Concerns\SdkParams;
use Bila\Core\Contracts\BaseModel;
use Bila\Transfers\TransferInitiateMobileMoneyTransferParams\Country;
use Bila\Transfers\TransferInitiateMobileMoneyTransferParams\Operator;

/**
 * Initiate a transfer to a mobile money account. Creates a transaction record in your dashboard.
 *
 * @see Bila\Services\TransfersService::initiateMobileMoneyTransfer()
 *
 * @phpstan-type TransferInitiateMobileMoneyTransferParamsShape = array{
 *   amount: float,
 *   country: Country|value-of<Country>,
 *   operator: Operator|value-of<Operator>,
 *   phone: string,
 *   reference: string,
 *   narration?: string|null,
 *   recipientName?: string|null,
 *   walletID?: string|null,
 * }
 */
final class TransferInitiateMobileMoneyTransferParams implements BaseModel
{
    /** @use SdkModel<TransferInitiateMobileMoneyTransferParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Transfer amount.
     */
    #[Required]
    public float $amount;

    /**
     * Country code.
     *
     * @var value-of<Country> $country
     */
    #[Required(enum: Country::class)]
    public string $country;

    /**
     * Mobile money operator.
     *
     * @var value-of<Operator> $operator
     */
    #[Required(enum: Operator::class)]
    public string $operator;

    /**
     * Recipient phone number.
     */
    #[Required]
    public string $phone;

    /**
     * Unique client reference.
     */
    #[Required]
    public string $reference;

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
     * Source wallet ID to debit (defaults to main wallet if omitted).
     */
    #[Optional('walletId')]
    public ?string $walletID;

    /**
     * `new TransferInitiateMobileMoneyTransferParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TransferInitiateMobileMoneyTransferParams::with(
     *   amount: ..., country: ..., operator: ..., phone: ..., reference: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TransferInitiateMobileMoneyTransferParams)
     *   ->withAmount(...)
     *   ->withCountry(...)
     *   ->withOperator(...)
     *   ->withPhone(...)
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
     * @param Country|value-of<Country> $country
     * @param Operator|value-of<Operator> $operator
     */
    public static function with(
        float $amount,
        Country|string $country,
        Operator|string $operator,
        string $phone,
        string $reference,
        ?string $narration = null,
        ?string $recipientName = null,
        ?string $walletID = null,
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['country'] = $country;
        $self['operator'] = $operator;
        $self['phone'] = $phone;
        $self['reference'] = $reference;

        null !== $narration && $self['narration'] = $narration;
        null !== $recipientName && $self['recipientName'] = $recipientName;
        null !== $walletID && $self['walletID'] = $walletID;

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
     * Mobile money operator.
     *
     * @param Operator|value-of<Operator> $operator
     */
    public function withOperator(Operator|string $operator): self
    {
        $self = clone $this;
        $self['operator'] = $operator;

        return $self;
    }

    /**
     * Recipient phone number.
     */
    public function withPhone(string $phone): self
    {
        $self = clone $this;
        $self['phone'] = $phone;

        return $self;
    }

    /**
     * Unique client reference.
     */
    public function withReference(string $reference): self
    {
        $self = clone $this;
        $self['reference'] = $reference;

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
     * Source wallet ID to debit (defaults to main wallet if omitted).
     */
    public function withWalletID(string $walletID): self
    {
        $self = clone $this;
        $self['walletID'] = $walletID;

        return $self;
    }
}
