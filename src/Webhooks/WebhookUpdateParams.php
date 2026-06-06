<?php

declare(strict_types=1);

namespace Bila\Webhooks;

use Bila\Core\Attributes\Optional;
use Bila\Core\Concerns\SdkModel;
use Bila\Core\Concerns\SdkParams;
use Bila\Core\Contracts\BaseModel;
use Bila\Webhooks\WebhookUpdateParams\Event;

/**
 * Update a webhook config.
 *
 * @see Bila\Services\WebhooksService::update()
 *
 * @phpstan-type WebhookUpdateParamsShape = array{
 *   events?: list<Event|value-of<Event>>|null,
 *   isActive?: bool|null,
 *   url?: string|null,
 * }
 */
final class WebhookUpdateParams implements BaseModel
{
    /** @use SdkModel<WebhookUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Event types to subscribe to.
     *
     * @var list<value-of<Event>>|null $events
     */
    #[Optional(list: Event::class)]
    public ?array $events;

    /**
     * Whether the webhook is active.
     */
    #[Optional]
    public ?bool $isActive;

    /**
     * Webhook endpoint URL.
     */
    #[Optional]
    public ?string $url;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Event|value-of<Event>>|null $events
     */
    public static function with(
        ?array $events = null,
        ?bool $isActive = null,
        ?string $url = null
    ): self {
        $self = new self;

        null !== $events && $self['events'] = $events;
        null !== $isActive && $self['isActive'] = $isActive;
        null !== $url && $self['url'] = $url;

        return $self;
    }

    /**
     * Event types to subscribe to.
     *
     * @param list<Event|value-of<Event>> $events
     */
    public function withEvents(array $events): self
    {
        $self = clone $this;
        $self['events'] = $events;

        return $self;
    }

    /**
     * Whether the webhook is active.
     */
    public function withIsActive(bool $isActive): self
    {
        $self = clone $this;
        $self['isActive'] = $isActive;

        return $self;
    }

    /**
     * Webhook endpoint URL.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
