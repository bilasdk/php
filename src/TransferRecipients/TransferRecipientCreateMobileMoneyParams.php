<?php

declare(strict_types=1);

namespace Bila\TransferRecipients;

use Bila\Core\Attributes\Optional;
use Bila\Core\Attributes\Required;
use Bila\Core\Concerns\SdkModel;
use Bila\Core\Concerns\SdkParams;
use Bila\Core\Contracts\BaseModel;
use Bila\TransferRecipients\TransferRecipientCreateMobileMoneyParams\Country;
use Bila\TransferRecipients\TransferRecipientCreateMobileMoneyParams\Operator;

/**
 * Create a new mobile money transfer recipient.
 *
 * @see Bila\Services\TransferRecipientsService::createMobileMoney()
 *
 * @phpstan-type TransferRecipientCreateMobileMoneyParamsShape = array{
 *   country: Country|value-of<Country>,
 *   operator: Operator|value-of<Operator>,
 *   phone: string,
 *   accountName?: string|null,
 * }
 */
final class TransferRecipientCreateMobileMoneyParams implements BaseModel
{
    /** @use SdkModel<TransferRecipientCreateMobileMoneyParamsShape> */
    use SdkModel;
    use SdkParams;

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
     * Mobile phone number.
     */
    #[Required]
    public string $phone;

    /**
     * Account holder name (optional, will be resolved).
     */
    #[Optional]
    public ?string $accountName;

    /**
     * `new TransferRecipientCreateMobileMoneyParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TransferRecipientCreateMobileMoneyParams::with(
     *   country: ..., operator: ..., phone: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TransferRecipientCreateMobileMoneyParams)
     *   ->withCountry(...)
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
     *
     * @param Country|value-of<Country> $country
     * @param Operator|value-of<Operator> $operator
     */
    public static function with(
        Country|string $country,
        Operator|string $operator,
        string $phone,
        ?string $accountName = null,
    ): self {
        $self = new self;

        $self['country'] = $country;
        $self['operator'] = $operator;
        $self['phone'] = $phone;

        null !== $accountName && $self['accountName'] = $accountName;

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
     * Mobile phone number.
     */
    public function withPhone(string $phone): self
    {
        $self = clone $this;
        $self['phone'] = $phone;

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
}
