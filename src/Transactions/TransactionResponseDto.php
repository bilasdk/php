<?php

declare(strict_types=1);

namespace Bila\Transactions;

use Bila\Core\Attributes\Optional;
use Bila\Core\Attributes\Required;
use Bila\Core\Concerns\SdkModel;
use Bila\Core\Contracts\BaseModel;
use Bila\Transactions\TransactionResponseDto\Status;
use Bila\Transactions\TransactionResponseDto\Type;

/**
 * @phpstan-type TransactionResponseDtoShape = array{
 *   id: string,
 *   accountID: string,
 *   amount: float,
 *   balanceAfter: float,
 *   balanceBefore: float,
 *   createdAt: \DateTimeInterface,
 *   currency: string,
 *   status: Status|value-of<Status>,
 *   type: Type|value-of<Type>,
 *   description?: string|null,
 *   reference?: string|null,
 * }
 */
final class TransactionResponseDto implements BaseModel
{
    /** @use SdkModel<TransactionResponseDtoShape> */
    use SdkModel;

    /**
     * Transaction UUID.
     */
    #[Required]
    public string $id;

    /**
     * Account / wallet ID.
     */
    #[Required('accountId')]
    public string $accountID;

    /**
     * Transaction amount.
     */
    #[Required]
    public float $amount;

    /**
     * Balance after transaction.
     */
    #[Required]
    public float $balanceAfter;

    /**
     * Balance before transaction.
     */
    #[Required]
    public float $balanceBefore;

    /**
     * Transaction timestamp.
     */
    #[Required]
    public \DateTimeInterface $createdAt;

    /**
     * Currency code.
     */
    #[Required]
    public string $currency;

    /**
     * Transaction status.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * Transaction type.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Transaction description.
     */
    #[Optional]
    public ?string $description;

    /**
     * Client reference.
     */
    #[Optional]
    public ?string $reference;

    /**
     * `new TransactionResponseDto()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TransactionResponseDto::with(
     *   id: ...,
     *   accountID: ...,
     *   amount: ...,
     *   balanceAfter: ...,
     *   balanceBefore: ...,
     *   createdAt: ...,
     *   currency: ...,
     *   status: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TransactionResponseDto)
     *   ->withID(...)
     *   ->withAccountID(...)
     *   ->withAmount(...)
     *   ->withBalanceAfter(...)
     *   ->withBalanceBefore(...)
     *   ->withCreatedAt(...)
     *   ->withCurrency(...)
     *   ->withStatus(...)
     *   ->withType(...)
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
     * @param Status|value-of<Status> $status
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        string $accountID,
        float $amount,
        float $balanceAfter,
        float $balanceBefore,
        \DateTimeInterface $createdAt,
        string $currency,
        Status|string $status,
        Type|string $type,
        ?string $description = null,
        ?string $reference = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['accountID'] = $accountID;
        $self['amount'] = $amount;
        $self['balanceAfter'] = $balanceAfter;
        $self['balanceBefore'] = $balanceBefore;
        $self['createdAt'] = $createdAt;
        $self['currency'] = $currency;
        $self['status'] = $status;
        $self['type'] = $type;

        null !== $description && $self['description'] = $description;
        null !== $reference && $self['reference'] = $reference;

        return $self;
    }

    /**
     * Transaction UUID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Account / wallet ID.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * Transaction amount.
     */
    public function withAmount(float $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * Balance after transaction.
     */
    public function withBalanceAfter(float $balanceAfter): self
    {
        $self = clone $this;
        $self['balanceAfter'] = $balanceAfter;

        return $self;
    }

    /**
     * Balance before transaction.
     */
    public function withBalanceBefore(float $balanceBefore): self
    {
        $self = clone $this;
        $self['balanceBefore'] = $balanceBefore;

        return $self;
    }

    /**
     * Transaction timestamp.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Currency code.
     */
    public function withCurrency(string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * Transaction status.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Transaction type.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Transaction description.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Client reference.
     */
    public function withReference(string $reference): self
    {
        $self = clone $this;
        $self['reference'] = $reference;

        return $self;
    }
}
