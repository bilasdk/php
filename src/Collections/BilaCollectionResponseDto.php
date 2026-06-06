<?php

declare(strict_types=1);

namespace Bila\Collections;

use Bila\Collections\BilaCollectionResponseDto\FeeBearer;
use Bila\Collections\BilaCollectionResponseDto\Status;
use Bila\Core\Attributes\Optional;
use Bila\Core\Attributes\Required;
use Bila\Core\Concerns\SdkModel;
use Bila\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type BilaCollectionCustomerDtoShape from \Bila\Collections\BilaCollectionCustomerDto
 *
 * @phpstan-type BilaCollectionResponseDtoShape = array{
 *   id: string,
 *   amount: float,
 *   createdAt: \DateTimeInterface,
 *   currency: string,
 *   customer: BilaCollectionCustomerDto|BilaCollectionCustomerDtoShape,
 *   reference: string,
 *   status: Status|value-of<Status>,
 *   completedAt?: \DateTimeInterface|null,
 *   feeBearer?: null|FeeBearer|value-of<FeeBearer>,
 *   narration?: string|null,
 * }
 */
final class BilaCollectionResponseDto implements BaseModel
{
    /** @use SdkModel<BilaCollectionResponseDtoShape> */
    use SdkModel;

    /**
     * Collection ID.
     */
    #[Required]
    public string $id;

    /**
     * Collection amount.
     */
    #[Required]
    public float $amount;

    /**
     * Collection creation timestamp.
     */
    #[Required]
    public \DateTimeInterface $createdAt;

    /**
     * Currency code.
     */
    #[Required]
    public string $currency;

    /**
     * Customer details.
     */
    #[Required]
    public BilaCollectionCustomerDto $customer;

    /**
     * Client reference.
     */
    #[Required]
    public string $reference;

    /**
     * Collection status.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * Collection completion timestamp.
     */
    #[Optional]
    public ?\DateTimeInterface $completedAt;

    /**
     * Who bears the transaction fee.
     *
     * @var value-of<FeeBearer>|null $feeBearer
     */
    #[Optional(enum: FeeBearer::class)]
    public ?string $feeBearer;

    /**
     * Collection narration.
     */
    #[Optional]
    public ?string $narration;

    /**
     * `new BilaCollectionResponseDto()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BilaCollectionResponseDto::with(
     *   id: ...,
     *   amount: ...,
     *   createdAt: ...,
     *   currency: ...,
     *   customer: ...,
     *   reference: ...,
     *   status: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BilaCollectionResponseDto)
     *   ->withID(...)
     *   ->withAmount(...)
     *   ->withCreatedAt(...)
     *   ->withCurrency(...)
     *   ->withCustomer(...)
     *   ->withReference(...)
     *   ->withStatus(...)
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
     * @param BilaCollectionCustomerDto|BilaCollectionCustomerDtoShape $customer
     * @param Status|value-of<Status> $status
     * @param FeeBearer|value-of<FeeBearer>|null $feeBearer
     */
    public static function with(
        string $id,
        float $amount,
        \DateTimeInterface $createdAt,
        string $currency,
        BilaCollectionCustomerDto|array $customer,
        string $reference,
        Status|string $status,
        ?\DateTimeInterface $completedAt = null,
        FeeBearer|string|null $feeBearer = null,
        ?string $narration = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['amount'] = $amount;
        $self['createdAt'] = $createdAt;
        $self['currency'] = $currency;
        $self['customer'] = $customer;
        $self['reference'] = $reference;
        $self['status'] = $status;

        null !== $completedAt && $self['completedAt'] = $completedAt;
        null !== $feeBearer && $self['feeBearer'] = $feeBearer;
        null !== $narration && $self['narration'] = $narration;

        return $self;
    }

    /**
     * Collection ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

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
     * Collection creation timestamp.
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
     * Customer details.
     *
     * @param BilaCollectionCustomerDto|BilaCollectionCustomerDtoShape $customer
     */
    public function withCustomer(
        BilaCollectionCustomerDto|array $customer
    ): self {
        $self = clone $this;
        $self['customer'] = $customer;

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

    /**
     * Collection status.
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
     * Collection completion timestamp.
     */
    public function withCompletedAt(\DateTimeInterface $completedAt): self
    {
        $self = clone $this;
        $self['completedAt'] = $completedAt;

        return $self;
    }

    /**
     * Who bears the transaction fee.
     *
     * @param FeeBearer|value-of<FeeBearer> $feeBearer
     */
    public function withFeeBearer(FeeBearer|string $feeBearer): self
    {
        $self = clone $this;
        $self['feeBearer'] = $feeBearer;

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
