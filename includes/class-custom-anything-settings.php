<?php
/**
 * WP Better Settings
 *
 * A simplified OOP implementation of the WP Settings API.
 *
 * @package   TypistTech\WPBetterSettings
 *
 * @author    Typist Tech <custom-anything@typist.tech>
 * @copyright 2017 Typist Tech
 * @license   GPL-2.0+
 *
 * @see       https://www.typist.tech/projects/custom-anything
 * @see       https://github.com/TypistTech/custom-anything
 */

declare(strict_types=1);

namespace TypistTech\WPBetterSettings;

use TypistTech\WPBetterSettings\Factories\Fields\CheckboxFactory;
use TypistTech\WPBetterSettings\Factories\Fields\InputFactory;
use TypistTech\WPBetterSettings\Factories\Fields\TextareaFactory;
use TypistTech\WPBetterSettings\Factories\ViewFactory;
use TypistTech\WPBetterSettings\Fields\Checkbox;
use TypistTech\WPBetterSettings\Fields\Email;
use TypistTech\WPBetterSettings\Fields\Text;
use TypistTech\WPBetterSettings\Fields\Textarea;
use TypistTech\WPBetterSettings\Fields\Url;
use TypistTech\WPBetterSettings\Pages\MenuPage;
use TypistTech\WPBetterSettings\Pages\SubmenuPage;
use TypistTech\WPBetterSettings\Views\View;

/**
 * Final class Plugin.
 *
 * This class hooks our plugin into the WordPress life-cycle.
 */
class Plugin
{
    /**
     * The plugin option store.
     *
     * @var OptionStore
     */
    private $optionStore;

    /**
     * Plugin constructor.
     *
     * @param OptionStore $optionStore The plugin option store.
     */
    public function __construct(OptionStore $optionStore = null)
    {
        $this->optionStore = $optionStore ?? new OptionStore;
    }

    /**
     * Launch the initialization process.
     */
    public function init()
    {
        $pageRegistrar = new PageRegistrar($this->getPages());
        $settingRegistrar = new SettingRegistrar($this->optionStore, ...$this->getSections());

        add_action('admin_menu', [ $pageRegistrar, 'run' ]);
        add_action('admin_init', [ $settingRegistrar, 'run' ]);
    }

    /**
     * Page configs
     *
     * @return (MenuPage|SubmenuPage)[]
     */
    private function getPages(): array
    {
        $simple = new MenuPage(
            'ca-simple',
            __('Custom Anything', 'custom-anything')
        );


        $text = new SubmenuPage(
            'ca-simple',
            'ca-text',
            __('Text', 'custom-anything')
        );

        $email = new SubmenuPage(
            'ca-simple',
            'ca-email',
            __('Email', 'custom-anything')
        );

        $url = new SubmenuPage(
            'ca-simple',
            'ca-url',
            __('Url', 'custom-anything')
        );

        $checkbox = new SubmenuPage(
            'ca-simple',
            'ca-checkbox',
            __('Checkbox', 'custom-anything')
        );

        $textarea = new SubmenuPage(
            'ca-simple',
            'ca-textarea',
            __('Textarea', 'custom-anything')
        );

        $basic = new SubmenuPage(
            'ca-simple',
            'ca-basic-page',
            'Basic Page',
            'Basic Page without Tabs'
        );

        $basic->getDecorator()->setView(
            ViewFactory::build('basic-page')
        );

        $customView = new SubmenuPage(
            'ca-simple',
            'ca-custom-view',
            __('Custom View', 'custom-anything')
        );
        $customView->getDecorator()->setView(
            new View(plugin_dir_path(__FILE__) . '../admin/partials/custom-anything-admin-display.php')
        );

        return [
            $simple,
            $text,
            $email,
            $url,
            $checkbox,
            $textarea,
            $basic,
            $customView,
        ];
    }

    /**
     * Setting configs
     *
     * @return Section[]
     */
    private function getSections(): array
    {
        $simpleSection = new Section(
            'ca-simple',
            __('List of Supported Fields with Minimal Config', 'custom-anything'),
            new Text('ca_simple_text', __('Simple Text', 'custom-anything')),
            new Email('ca_simple_email', __('Simple Email', 'custom-anything')),
            new Url('ca_simple_url', __('Simple Url', 'custom-anything')),
            new Checkbox('ca_simple_checkbox', __('Simple Checkbox', 'custom-anything')),
            new Textarea('ca_simple_textarea', __('Simple Textarea', 'custom-anything'))
        );
        $simpleSection->getDecorator()
                      ->setContent('<p>I am <strong>section content</strong> with <code>html</code> tags.</p>');

        $basicSection = new Section(
            'ca-basic-page',
            __('List of Supported Fields with Minimal Config', 'custom-anything'),
            new Text('ca_basic_text', __('Simple Text', 'custom-anything'))
        );

        $inputFactory = new InputFactory($this->optionStore);

        $textDesc = $inputFactory->build(
            'ca_text_desc',
            __('With Description', 'custom-anything'),
            [
                'type' => 'text',
                'description' => 'I am a <strong>helpful description</strong> with <code>html</code> tags',
            ]
        );

        $textDisabled = $inputFactory->build(
            'ca_text_disabled',
            __('Disabled', 'custom-anything'),
            [
                'type' => 'text',
                'disabled' => true,
            ]
        );

        $textSmall = $inputFactory->build(
            'ca_text_small',
            __("With WordPress' <code>small-text</code> HTML class", 'custom-anything'),
            [
                'type' => 'text',
                'htmlClass' => 'small-text',
            ]
        );

        $textSection = new Section(
            'ca-text',
            __('Showcase of Different Field Configuration', 'custom-anything'),
            new Text('ca_text', __('Minimal', 'custom-anything')),
            $textDesc,
            $textDisabled,
            $textSmall
        );

        $emailDesc = $inputFactory->build(
            'ca_email_desc',
            __('With Description', 'custom-anything'),
            [
                'type' => 'email',
                'description' => 'I am a <strong>helpful description</strong> with <code>html</code> tags',
            ]
        );

        $emailDisabled = $inputFactory->build(
            'ca_email_disabled',
            __('Disabled', 'custom-anything'),
            [
                'type' => 'email',
                'disabled' => true,
            ]
        );

        $emailSmall = $inputFactory->build(
            'ca_email_small',
            __("With WordPress' <code>small-text</code> HTML class", 'custom-anything'),
            [
                'type' => 'email',
                'htmlClass' => 'small-text',
            ]
        );

        $emailSection = new Section(
            'ca-email',
            __('Showcase of Different Field Configuration', 'custom-anything'),
            new Email('ca_email', __('Minimal', 'custom-anything')),
            $emailDesc,
            $emailDisabled,
            $emailSmall
        );

        $urlDesc = $inputFactory->build(
            'ca_url_desc',
            __('With Description', 'custom-anything'),
            [
                'type' => 'url',
                'description' => 'I am a <strong>helpful description</strong> with <code>html</code> tags',
            ]
        );

        $urlDisabled = $inputFactory->build(
            'ca_url_disabled',
            __('Disabled', 'custom-anything'),
            [
                'type' => 'url',
                'disabled' => true,
            ]
        );

        $urlSmall = $inputFactory->build(
            'ca_url_small',
            __("With WordPress' <code>small-text</code> HTML class", 'custom-anything'),
            [
                'type' => 'url',
                'htmlClass' => 'small-text',
            ]
        );

        $urlSection = new Section(
            'ca-url',
            __('Showcase of Different Field Configuration', 'custom-anything'),
            new Url('ca_url', __('Minimal', 'custom-anything')),
            $urlDesc,
            $urlDisabled,
            $urlSmall
        );

        $checkboxFactory = new CheckboxFactory($this->optionStore);

        $checkboxDesc = $checkboxFactory->build(
            'ca_checkbox_desc',
            __('With Description', 'custom-anything'),
            [
                'description' => 'I am a <strong>helpful description</strong> with <code>html</code> tags',
            ]
        );

        $checkboxDisabled = $checkboxFactory->build(
            'ca_checkbox_disabled',
            __('Disabled', 'custom-anything'),
            [
                'disabled' => true,
            ]
        );

        $checkboxLabel = $checkboxFactory->build(
            'ca_checkbox_label',
            __('With Label', 'custom-anything'),
            [
                'label' => 'I am a <strong>helpful label</strong> with <code>html</code> tags',
            ]
        );

        $checkboxSection = new Section(
            'ca-checkbox',
            __('Showcase of Different Field Configuration', 'custom-anything'),
            new Checkbox('ca_checkbox', __('Minimal', 'custom-anything')),
            $checkboxDesc,
            $checkboxDisabled,
            $checkboxLabel
        );

        $textareaFactory = new TextareaFactory($this->optionStore);

        $textareaDesc = $textareaFactory->build(
            'ca_textarea_desc',
            __('With Description', 'custom-anything'),
            [
                'description' => 'I am a <strong>helpful description</strong> with <code>html</code> tags',
            ]
        );

        $textareaDisabled = $textareaFactory->build(
            'ca_textarea_disabled',
            __('Disabled', 'custom-anything'),
            [
                'disabled' => true,
            ]
        );

        $textareaSmall = $textareaFactory->build(
            'ca_textarea_small',
            __("With WordPress' <code>small-text</code> HTML class", 'custom-anything'),
            [
                'htmlClass' => 'small-text',
            ]
        );

        $textareaRows = $textareaFactory->build(
            'ca_textarea_small',
            __("With WordPress' <code>small-text</code> HTML class", 'custom-anything'),
            [
                'rows' => 10,
            ]
        );

        $textareaSection = new Section(
            'ca-textarea',
            __('Showcase of Different Field Configuration', 'custom-anything'),
            new Textarea('ca_textarea', __('Minimal', 'custom-anything')),
            $textareaDesc,
            $textareaDisabled,
            $textareaSmall,
            $textareaRows
        );

        return [
            $simpleSection,
            $basicSection,
            $textSection,
            $emailSection,
            $urlSection,
            $checkboxSection,
            $textareaSection,
        ];
    }
}

function card_starts()
{
    echo '<div class="card">';
}

function card_ends()
{
    echo '</div>';
}

add_action('ca_simple_before_option_form', 'TypistTech\WPBetterSettings\card_starts');
add_action('ca_simple_after_option_form', 'TypistTech\WPBetterSettings\card_ends');


