<?php

declare(strict_types=1);

namespace Bila\Webhooks;

use Bila\Core\Attributes\Required;
use Bila\Core\Concerns\SdkModel;
use Bila\Core\Contracts\BaseModel;

/**
 * @phpstan-type WebhookConfigResponseDtoShape = array{
 *   id: string,
 *   createdAt: \DateTimeInterface,
 *   events: list<string>,
 *   isActive: bool,
 *   merchantID: string,
 *   secret: string,
 *   updatedAt: \DateTimeInterface,
 *   url: string,
 * }
 */
final class WebhookConfigResponseDto implements BaseModel
{
    /** @use SdkModel<WebhookConfigResponseDtoShape> */
    use SdkModel;

    /**
     * Webhook config UUID.
     */
    #[Required]
    public string $id;

    #[Required]
    public \DateTimeInterface $createdAt;

    /**
     * Subscribed event types.
     *
     * @var list<string> $events
     */
    #[Required(list: 'string')]
    public array $events;

    /**
     * Whether the webhook is active.
     */
    #[Required]
    public bool $isActive;

    /**
     * Merchant UUID.
     */
    #[Required('merchantId')]
    public string $merchantID;

    /**
     * Signing secret; plaintext only on create/rotate-secret, otherwise masked.
     */
    #[Required]
    public string $secret;

    #[Required]
    public \DateTimeInterface $updatedAt;

    /**
     * Webhook endpoint URL.
     */
    #[Required]
    public string $url;

    /**
     * `new WebhookConfigResponseDto()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebhookConfigResponseDto::with(
     *   id: ...,
     *   createdAt: ...,
     *   events: ...,
     *   isActive: ...,
     *   merchantID: ...,
     *   secret: ...,
     *   updatedAt: ...,
     *   url: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebhookConfigResponseDto)
     *   ->withID(...)
     *   ->withCreatedAt(...)
     *   ->withEvents(...)
     *   ->withIsActive(...)
     *   ->withMerchantID(...)
     *   ->withSecret(...)
     *   ->withUpdatedAt(...)
     *   ->withURL(...)
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
     * @param list<string> $events
     */
    public static function with(
        string $id,
        \DateTimeInterface $createdAt,
        array $events,
        bool $isActive,
        string $merchantID,
        string $secret,
        \DateTimeInterface $updatedAt,
        string $url,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['createdAt'] = $createdAt;
        $self['events'] = $events;
        $self['isActive'] = $isActive;
        $self['merchantID'] = $merchantID;
        $self['secret'] = $secret;
        $self['updatedAt'] = $updatedAt;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Webhook config UUID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Subscribed event types.
     *
     * @param list<string> $events
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
     * Merchant UUID.
     */
    public function withMerchantID(string $merchantID): self
    {
        $self = clone $this;
        $self['merchantID'] = $merchantID;

        return $self;
    }

    /**
     * Signing secret; plaintext only on create/rotate-secret, otherwise masked.
     */
    public function withSecret(string $secret): self
    {
        $self = clone $this;
        $self['secret'] = $secret;

        return $self;
    }

    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

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
