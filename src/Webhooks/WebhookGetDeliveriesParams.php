<?php

declare(strict_types=1);

namespace Bila\Webhooks;

use Bila\Core\Attributes\Optional;
use Bila\Core\Concerns\SdkModel;
use Bila\Core\Concerns\SdkParams;
use Bila\Core\Contracts\BaseModel;

/**
 * Get delivery history.
 *
 * @see Bila\Services\WebhooksService::getDeliveries()
 *
 * @phpstan-type WebhookGetDeliveriesParamsShape = array{
 *   endDate?: string|null,
 *   eventType?: string|null,
 *   page?: float|null,
 *   perPage?: float|null,
 *   startDate?: string|null,
 *   status?: string|null,
 * }
 */
final class WebhookGetDeliveriesParams implements BaseModel
{
    /** @use SdkModel<WebhookGetDeliveriesParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * ISO 8601 end of createdAt range (inclusive).
     */
    #[Optional]
    public ?string $endDate;

    /**
     * Filter by event type.
     */
    #[Optional]
    public ?string $eventType;

    /**
     * Page number.
     */
    #[Optional]
    public ?float $page;

    /**
     * Items per page.
     */
    #[Optional]
    public ?float $perPage;

    /**
     * ISO 8601 start of createdAt range (inclusive).
     */
    #[Optional]
    public ?string $startDate;

    /**
     * Filter by status (QUEUED, DELIVERED, FAILED, RETRYING).
     */
    #[Optional]
    public ?string $status;

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
        ?string $endDate = null,
        ?string $eventType = null,
        ?float $page = null,
        ?float $perPage = null,
        ?string $startDate = null,
        ?string $status = null,
    ): self {
        $self = new self;

        null !== $endDate && $self['endDate'] = $endDate;
        null !== $eventType && $self['eventType'] = $eventType;
        null !== $page && $self['page'] = $page;
        null !== $perPage && $self['perPage'] = $perPage;
        null !== $startDate && $self['startDate'] = $startDate;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    /**
     * ISO 8601 end of createdAt range (inclusive).
     */
    public function withEndDate(string $endDate): self
    {
        $self = clone $this;
        $self['endDate'] = $endDate;

        return $self;
    }

    /**
     * Filter by event type.
     */
    public function withEventType(string $eventType): self
    {
        $self = clone $this;
        $self['eventType'] = $eventType;

        return $self;
    }

    /**
     * Page number.
     */
    public function withPage(float $page): self
    {
        $self = clone $this;
        $self['page'] = $page;

        return $self;
    }

    /**
     * Items per page.
     */
    public function withPerPage(float $perPage): self
    {
        $self = clone $this;
        $self['perPage'] = $perPage;

        return $self;
    }

    /**
     * ISO 8601 start of createdAt range (inclusive).
     */
    public function withStartDate(string $startDate): self
    {
        $self = clone $this;
        $self['startDate'] = $startDate;

        return $self;
    }

    /**
     * Filter by status (QUEUED, DELIVERED, FAILED, RETRYING).
     */
    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
