<?php

declare(strict_types=1);

namespace Bila\Webhooks;

use Bila\Core\Attributes\Required;
use Bila\Core\Concerns\SdkModel;
use Bila\Core\Concerns\SdkParams;
use Bila\Core\Contracts\BaseModel;
use Bila\Webhooks\WebhookCreateParams\Event;

/**
 * Create a webhook config.
 *
 * @see Bila\Services\WebhooksService::create()
 *
 * @phpstan-type WebhookCreateParamsShape = array{
 *   events: list<Event|value-of<Event>>, url: string
 * }
 */
final class WebhookCreateParams implements BaseModel
{
    /** @use SdkModel<WebhookCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Event types to subscribe to.
     *
     * @var list<value-of<Event>> $events
     */
    #[Required(list: Event::class)]
    public array $events;

    /**
     * Webhook endpoint URL.
     */
    #[Required]
    public string $url;

    /**
     * `new WebhookCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebhookCreateParams::with(events: ..., url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebhookCreateParams)->withEvents(...)->withURL(...)
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
     * @param list<Event|value-of<Event>> $events
     */
    public static function with(array $events, string $url): self
    {
        $self = new self;

        $self['events'] = $events;
        $self['url'] = $url;

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
     * Webhook endpoint URL.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
