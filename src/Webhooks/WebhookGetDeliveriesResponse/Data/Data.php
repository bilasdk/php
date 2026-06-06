<?php

declare(strict_types=1);

namespace Bila\Webhooks\WebhookGetDeliveriesResponse\Data;

use Bila\Core\Attributes\Required;
use Bila\Core\Concerns\SdkModel;
use Bila\Core\Contracts\BaseModel;
use Bila\Webhooks\WebhookGetDeliveriesResponse\Data\Data\Status;

/**
 * @phpstan-type DataShape = array{
 *   id: string,
 *   attempts: float,
 *   createdAt: \DateTimeInterface,
 *   deliveredAt: \DateTimeInterface|null,
 *   eventType: string,
 *   failedAt: \DateTimeInterface|null,
 *   maxAttempts: float,
 *   nextRetryAt: \DateTimeInterface|null,
 *   payload: array<string,mixed>,
 *   responseBody: string|null,
 *   responseStatus: float|null,
 *   status: Status|value-of<Status>,
 *   webhookConfigID: string,
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /**
     * Delivery UUID.
     */
    #[Required]
    public string $id;

    /**
     * Number of delivery attempts.
     */
    #[Required]
    public float $attempts;

    #[Required]
    public \DateTimeInterface $createdAt;

    /**
     * When the delivery succeeded.
     */
    #[Required]
    public ?\DateTimeInterface $deliveredAt;

    /**
     * Webhook event type.
     */
    #[Required]
    public string $eventType;

    /**
     * When the delivery permanently failed.
     */
    #[Required]
    public ?\DateTimeInterface $failedAt;

    /**
     * Maximum delivery attempts.
     */
    #[Required]
    public float $maxAttempts;

    /**
     * When the next retry is scheduled.
     */
    #[Required]
    public ?\DateTimeInterface $nextRetryAt;

    /**
     * Event payload JSON as stored for delivery.
     *
     * @var array<string,mixed> $payload
     */
    #[Required(map: 'mixed')]
    public array $payload;

    /**
     * Response body from the merchant endpoint (truncated).
     */
    #[Required]
    public ?string $responseBody;

    /**
     * HTTP status code from the merchant endpoint.
     */
    #[Required]
    public ?float $responseStatus;

    /**
     * Delivery status.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * Webhook config UUID.
     */
    #[Required('webhookConfigId')]
    public string $webhookConfigID;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(
     *   id: ...,
     *   attempts: ...,
     *   createdAt: ...,
     *   deliveredAt: ...,
     *   eventType: ...,
     *   failedAt: ...,
     *   maxAttempts: ...,
     *   nextRetryAt: ...,
     *   payload: ...,
     *   responseBody: ...,
     *   responseStatus: ...,
     *   status: ...,
     *   webhookConfigID: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Data)
     *   ->withID(...)
     *   ->withAttempts(...)
     *   ->withCreatedAt(...)
     *   ->withDeliveredAt(...)
     *   ->withEventType(...)
     *   ->withFailedAt(...)
     *   ->withMaxAttempts(...)
     *   ->withNextRetryAt(...)
     *   ->withPayload(...)
     *   ->withResponseBody(...)
     *   ->withResponseStatus(...)
     *   ->withStatus(...)
     *   ->withWebhookConfigID(...)
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
     * @param array<string,mixed> $payload
     * @param Status|value-of<Status> $status
     */
    public static function with(
        string $id,
        float $attempts,
        \DateTimeInterface $createdAt,
        ?\DateTimeInterface $deliveredAt,
        string $eventType,
        ?\DateTimeInterface $failedAt,
        float $maxAttempts,
        ?\DateTimeInterface $nextRetryAt,
        array $payload,
        ?string $responseBody,
        ?float $responseStatus,
        Status|string $status,
        string $webhookConfigID,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['attempts'] = $attempts;
        $self['createdAt'] = $createdAt;
        $self['deliveredAt'] = $deliveredAt;
        $self['eventType'] = $eventType;
        $self['failedAt'] = $failedAt;
        $self['maxAttempts'] = $maxAttempts;
        $self['nextRetryAt'] = $nextRetryAt;
        $self['payload'] = $payload;
        $self['responseBody'] = $responseBody;
        $self['responseStatus'] = $responseStatus;
        $self['status'] = $status;
        $self['webhookConfigID'] = $webhookConfigID;

        return $self;
    }

    /**
     * Delivery UUID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Number of delivery attempts.
     */
    public function withAttempts(float $attempts): self
    {
        $self = clone $this;
        $self['attempts'] = $attempts;

        return $self;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * When the delivery succeeded.
     */
    public function withDeliveredAt(?\DateTimeInterface $deliveredAt): self
    {
        $self = clone $this;
        $self['deliveredAt'] = $deliveredAt;

        return $self;
    }

    /**
     * Webhook event type.
     */
    public function withEventType(string $eventType): self
    {
        $self = clone $this;
        $self['eventType'] = $eventType;

        return $self;
    }

    /**
     * When the delivery permanently failed.
     */
    public function withFailedAt(?\DateTimeInterface $failedAt): self
    {
        $self = clone $this;
        $self['failedAt'] = $failedAt;

        return $self;
    }

    /**
     * Maximum delivery attempts.
     */
    public function withMaxAttempts(float $maxAttempts): self
    {
        $self = clone $this;
        $self['maxAttempts'] = $maxAttempts;

        return $self;
    }

    /**
     * When the next retry is scheduled.
     */
    public function withNextRetryAt(?\DateTimeInterface $nextRetryAt): self
    {
        $self = clone $this;
        $self['nextRetryAt'] = $nextRetryAt;

        return $self;
    }

    /**
     * Event payload JSON as stored for delivery.
     *
     * @param array<string,mixed> $payload
     */
    public function withPayload(array $payload): self
    {
        $self = clone $this;
        $self['payload'] = $payload;

        return $self;
    }

    /**
     * Response body from the merchant endpoint (truncated).
     */
    public function withResponseBody(?string $responseBody): self
    {
        $self = clone $this;
        $self['responseBody'] = $responseBody;

        return $self;
    }

    /**
     * HTTP status code from the merchant endpoint.
     */
    public function withResponseStatus(?float $responseStatus): self
    {
        $self = clone $this;
        $self['responseStatus'] = $responseStatus;

        return $self;
    }

    /**
     * Delivery status.
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
     * Webhook config UUID.
     */
    public function withWebhookConfigID(string $webhookConfigID): self
    {
        $self = clone $this;
        $self['webhookConfigID'] = $webhookConfigID;

        return $self;
    }
}
