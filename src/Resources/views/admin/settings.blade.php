// src/Resources/views/admin/settings.blade.php
@extends('admin::layouts.content')

@section('page_title')
    {{ __('whatsapp::app.admin.settings.title') }}
@stop

@section('content')
    <div class="content">
        <form method="POST" action="{{ route('admin.whatsapp.settings.update') }}" @submit.prevent="onSubmit">
            @csrf
            <div class="page-header">
                <div class="page-title">
                    <h1>{{ __('whatsapp::app.admin.settings.title') }}</h1>
                </div>
                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('admin::app.save') }}
                    </button>
                </div>
            </div>

            <div class="page-content">
                <div class="form-container">
                    <div class="control-group" :class="[errors.has('phone_number') ? 'has-error' : '']">
                        <label for="phone_number" class="required">
                            {{ __('whatsapp::app.admin.settings.phone_number') }}
                        </label>
                        <input
                            type="text"
                            class="control"
                            id="phone_number"
                            name="phone_number"
                            v-validate="'required'"
                            value="{{ config('whatsapp-chat.phone_number') }}"
                            data-vv-as="&quot;{{ __('whatsapp::app.admin.settings.phone_number') }}&quot;"
                        />
                        <span class="control-error" v-if="errors.has('phone_number')">
                            @{{ errors.first('phone_number') }}
                        </span>
                    </div>

                    <div class="control-group" :class="[errors.has('default_message') ? 'has-error' : '']">
                        <label for="default_message" class="required">
                            {{ __('whatsapp::app.admin.settings.default_message') }}
                        </label>
                        <textarea
                            class="control"
                            id="default_message"
                            name="default_message"
                            v-validate="'required'"
                            data-vv-as="&quot;{{ __('whatsapp::app.admin.settings.default_message') }}&quot;"
                        >{{ config('whatsapp-chat.default_message') }}</textarea>
                        <span class="control-error" v-if="errors.has('default_message')">
                            @{{ errors.first('default_message') }}
                        </span>
                    </div>

                    <div class="control-group" :class="[errors.has('button_style') ? 'has-error' : '']">
                        <label for="button_style">
                            {{ __('whatsapp::app.admin.settings.button_style') }}
                        </label>
                        <select class="control" id="button_style" name="button_style">
                            <option value="green" {{ config('whatsapp-chat.button_style') == 'green' ? 'selected' : '' }}>
                                {{ __('whatsapp::app.admin.settings.green') }}
                            </option>
                            <option value="white" {{ config('whatsapp-chat.button_style') == 'white' ? 'selected' : '' }}>
                                {{ __('whatsapp::app.admin.settings.white') }}
                            </option>
                        </select>
                    </div>

                    <div class="control-group" :class="[errors.has('button_size') ? 'has-error' : '']">
                        <label for="button_size">
                            {{ __('whatsapp::app.admin.settings.button_size') }}
                        </label>
                        <select class="control" id="button_size" name="button_size">
                            <option value="small" {{ config('whatsapp-chat.button_size') == 'small' ? 'selected' : '' }}>
                                {{ __('whatsapp::app.admin.settings.small') }}
                            </option>
                            <option value="medium" {{ config('whatsapp-chat.button_size') == 'medium' ? 'selected' : '' }}>
                                {{ __('whatsapp::app.admin.settings.medium') }}
                            </option>
                            <option value="large" {{ config('whatsapp-chat.button_size') == 'large' ? 'selected' : '' }}>
                                {{ __('whatsapp::app.admin.settings.large') }}
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop
