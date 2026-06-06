<?php

declare(strict_types=1);

namespace Bila\Transfers;

use Bila\Core\Attributes\Optional;
use Bila\Core\Attributes\Required;
use Bila\Core\Concerns\SdkModel;
use Bila\Core\Contracts\BaseModel;
use Bila\Transfers\TransferResponseDto\Status;
use Bila\Transfers\TransferResponseDto\Type;

/**
 * @phpstan-import-type TransferRecipientDtoShape from \Bila\Transfers\TransferRecipientDto
 *
 * @phpstan-type TransferResponseDtoShape = array{
 *   id: string,
 *   amount: float,
 *   createdAt: \DateTimeInterface,
 *   currency: string,
 *   recipient: TransferRecipientDto|TransferRecipientDtoShape,
 *   reference: string,
 *   status: Status|value-of<Status>,
 *   type: Type|value-of<Type>,
 *   completedAt?: \DateTimeInterface|null,
 *   narration?: string|null,
 * }
 */
final class TransferResponseDto implements BaseModel
{
    /** @use SdkModel<TransferResponseDtoShape> */
    use SdkModel;

    /**
     * Transfer ID.
     */
    #[Required]
    public string $id;

    /**
     * Transfer amount.
     */
    #[Required]
    public float $amount;

    /**
     * Creation timestamp (from Payment).
     */
    #[Required]
    public \DateTimeInterface $createdAt;

    /**
     * Currency code.
     */
    #[Required]
    public string $currency;

    /**
     * Recipient details.
     */
    #[Required]
    public TransferRecipientDto $recipient;

    /**
     * Client reference.
     */
    #[Required]
    public string $reference;

    /**
     * Transfer status.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * Transfer recipient type.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Completion timestamp (from Payment.processedAt).
     */
    #[Optional]
    public ?\DateTimeInterface $completedAt;

    /**
     * Transfer narration.
     */
    #[Optional]
    public ?string $narration;

    /**
     * `new TransferResponseDto()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TransferResponseDto::with(
     *   id: ...,
     *   amount: ...,
     *   createdAt: ...,
     *   currency: ...,
     *   recipient: ...,
     *   reference: ...,
     *   status: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TransferResponseDto)
     *   ->withID(...)
     *   ->withAmount(...)
     *   ->withCreatedAt(...)
     *   ->withCurrency(...)
     *   ->withRecipient(...)
     *   ->withReference(...)
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
     * @param TransferRecipientDto|TransferRecipientDtoShape $recipient
     * @param Status|value-of<Status> $status
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        float $amount,
        \DateTimeInterface $createdAt,
        string $currency,
        TransferRecipientDto|array $recipient,
        string $reference,
        Status|string $status,
        Type|string $type,
        ?\DateTimeInterface $completedAt = null,
        ?string $narration = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['amount'] = $amount;
        $self['createdAt'] = $createdAt;
        $self['currency'] = $currency;
        $self['recipient'] = $recipient;
        $self['reference'] = $reference;
        $self['status'] = $status;
        $self['type'] = $type;

        null !== $completedAt && $self['completedAt'] = $completedAt;
        null !== $narration && $self['narration'] = $narration;

        return $self;
    }

    /**
     * Transfer ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

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
     * Creation timestamp (from Payment).
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
     * Recipient details.
     *
     * @param TransferRecipientDto|TransferRecipientDtoShape $recipient
     */
    public function withRecipient(TransferRecipientDto|array $recipient): self
    {
        $self = clone $this;
        $self['recipient'] = $recipient;

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
     * Transfer status.
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
     * Transfer recipient type.
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
     * Completion timestamp (from Payment.processedAt).
     */
    public function withCompletedAt(\DateTimeInterface $completedAt): self
    {
        $self = clone $this;
        $self['completedAt'] = $completedAt;

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
}
