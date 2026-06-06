<?php

declare(strict_types=1);

namespace Bila\Collections;

use Bila\Collections\CollectionInitiateMobileMoneyCollectionParams\Bearer;
use Bila\Collections\CollectionInitiateMobileMoneyCollectionParams\Country;
use Bila\Collections\CollectionInitiateMobileMoneyCollectionParams\Operator;
use Bila\Core\Attributes\Optional;
use Bila\Core\Attributes\Required;
use Bila\Core\Concerns\SdkModel;
use Bila\Core\Concerns\SdkParams;
use Bila\Core\Contracts\BaseModel;

/**
 * Initiate a payment collection from a mobile money account. Creates a transaction record in your dashboard.
 *
 * @see Bila\Services\CollectionsService::initiateMobileMoneyCollection()
 *
 * @phpstan-type CollectionInitiateMobileMoneyCollectionParamsShape = array{
 *   amount: float,
 *   country: Country|value-of<Country>,
 *   operator: Operator|value-of<Operator>,
 *   phone: string,
 *   reference: string,
 *   walletID: string,
 *   bearer?: null|Bearer|value-of<Bearer>,
 *   customerName?: string|null,
 *   narration?: string|null,
 * }
 */
final class CollectionInitiateMobileMoneyCollectionParams implements BaseModel
{
    /** @use SdkModel<CollectionInitiateMobileMoneyCollectionParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Collection amount.
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
     * Customer phone number.
     */
    #[Required]
    public string $phone;

    /**
     * Unique client reference.
     */
    #[Required]
    public string $reference;

    /**
     * Target wallet ID to credit.
     */
    #[Required('walletId')]
    public string $walletID;

    /**
     * Who bears the transaction fee.
     *
     * @var value-of<Bearer>|null $bearer
     */
    #[Optional(enum: Bearer::class)]
    public ?string $bearer;

    /**
     * Customer name for the transaction record.
     */
    #[Optional]
    public ?string $customerName;

    /**
     * Collection narration.
     */
    #[Optional]
    public ?string $narration;

    /**
     * `new CollectionInitiateMobileMoneyCollectionParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CollectionInitiateMobileMoneyCollectionParams::with(
     *   amount: ...,
     *   country: ...,
     *   operator: ...,
     *   phone: ...,
     *   reference: ...,
     *   walletID: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CollectionInitiateMobileMoneyCollectionParams)
     *   ->withAmount(...)
     *   ->withCountry(...)
     *   ->withOperator(...)
     *   ->withPhone(...)
     *   ->withReference(...)
     *   ->withWalletID(...)
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
     * @param Bearer|value-of<Bearer>|null $bearer
     */
    public static function with(
        float $amount,
        Country|string $country,
        Operator|string $operator,
        string $phone,
        string $reference,
        string $walletID,
        Bearer|string|null $bearer = null,
        ?string $customerName = null,
        ?string $narration = null,
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['country'] = $country;
        $self['operator'] = $operator;
        $self['phone'] = $phone;
        $self['reference'] = $reference;
        $self['walletID'] = $walletID;

        null !== $bearer && $self['bearer'] = $bearer;
        null !== $customerName && $self['customerName'] = $customerName;
        null !== $narration && $self['narration'] = $narration;

        return $self;
    }

    /**
     * Collection amount.
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
     * Customer phone number.
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
     * Target wallet ID to credit.
     */
    public function withWalletID(string $walletID): self
    {
        $self = clone $this;
        $self['walletID'] = $walletID;

        return $self;
    }

    /**
     * Who bears the transaction fee.
     *
     * @param Bearer|value-of<Bearer> $bearer
     */
    public function withBearer(Bearer|string $bearer): self
    {
        $self = clone $this;
        $self['bearer'] = $bearer;

        return $self;
    }

    /**
     * Customer name for the transaction record.
     */
    public function withCustomerName(string $customerName): self
    {
        $self = clone $this;
        $self['customerName'] = $customerName;

        return $self;
    }

    /**
     * Collection narration.
     */
    public function withNarration(string $narration): self
    {
        $self = clone $this;
        $self['narration'] = $narration;

        return $self;
    }
}
