<template>
    <div class="editor">
        <editor-menu-bar :editor="editor" v-slot="{ commands, isActive }">
            <div class="menubar">

                <button class="menubar__button btn" :class="{ 'btn-primary': isActive.bold() }" @click="commands.bold">
                    <font-awesome-icon icon="bold" />
                </button>

                <button class="menubar__button btn" :class="{ 'btn-primary': isActive.italic() }" @click="commands.italic">
                    <font-awesome-icon icon="italic" />
                </button>

                <button class="menubar__button btn" :class="{ 'btn-primary': isActive.strike() }" @click="commands.strike">
                    <font-awesome-icon icon="strikethrough" />
                </button>

                <button class="menubar__button btn" :class="{ 'btn-primary': isActive.underline() }"
                    @click="commands.underline">
                    <font-awesome-icon icon="underline" />
                </button>

                <button class="menubar__button btn" :class="{ 'btn-primary': isActive.paragraph() }"
                    @click="commands.paragraph">
                    <font-awesome-icon icon="paragraph" />
                </button>

                <button class="menubar__button btn" :class="{ 'btn-primary': isActive.heading({ level: 1 }) }"
                    @click="commands.heading({ level: 1 })">
                    H1
                </button>

                <button class="menubar__button btn" :class="{ 'btn-primary': isActive.heading({ level: 2 }) }"
                    @click="commands.heading({ level: 2 })">
                    H2
                </button>

                <button class="menubar__button btn" :class="{ 'btn-primary': isActive.heading({ level: 3 }) }"
                    @click="commands.heading({ level: 3 })">
                    H3
                </button>

                <button class="menubar__button btn" :class="{ 'btn-primary': isActive.bullet_list() }"
                    @click="commands.bullet_list">
                    <font-awesome-icon icon="list-ul" />
                </button>

                <button class="menubar__button btn" :class="{ 'btn-primary': isActive.ordered_list() }"
                    @click="commands.ordered_list">
                    <font-awesome-icon icon="list-ol" />
                </button>

                <button class="menubar__button btn" @click="commands.horizontal_rule">
                    -
                </button>

                <button class="menubar__button btn" @click="commands.undo">
                    <font-awesome-icon icon="undo" />
                </button>

                <button class="menubar__button btn" @click="commands.redo">
                    <font-awesome-icon icon="redo" />
                </button>

            </div>
        </editor-menu-bar>
        <editor-menu-bubble class="menububble" :editor="editor" @hide="hideLinkMenu" v-slot="{ commands, isActive, getMarkAttrs, menu }">
            <div class="menububble" :class="{ 'is-active': menu.isActive }" :style="`left: ${menu.left}px; bottom: ${menu.bottom}px;`">
                <form class="menububble__form" v-if="linkMenuIsActive" @submit.prevent="setLinkUrl(commands.link, linkUrl)">
                    <input class="menububble__input" type="text" v-model="linkUrl" placeholder="https://" ref="linkInput" @keydown.esc="hideLinkMenu"/>
                    <button class="menububble__button" @click="setLinkUrl(commands.link, null)" type="button">
                        <font-awesome-icon icon="unlink" />
                    </button>
                </form>
                <template v-else>
                    <button class="menububble__button" @click="showLinkMenu(getMarkAttrs('link'))" :class="{ 'is-active': isActive.link() }">
                        <span>{{ isActive.link() ? 'Update Link' : 'Add Link'}}</span>
                        <font-awesome-icon icon="link" />
                    </button>
                </template>
            </div>
        </editor-menu-bubble>
        <editor-content class="editor__content mt-10" :editor="editor" />
    </div>
</template>

<style lang="scss">
    .menububble {
        position: absolute;
        display: flex;
        z-index: 20;
        background: #111417;
        border-radius: 5px;
        padding: 0.3rem;
        margin-bottom: 0.5rem;
        transform: translateX(-50%);
        visibility: hidden;
        opacity: 0;
        transition: opacity 0.2s, visibility 0.2s;

        &.is-active {
            opacity: 1;
            visibility: visible;
        }

        &__button {
            display: inline-flex;
            background: transparent;
            border: 0;
            color: #ffffff;
            padding: 0.2rem 0.5rem;
            margin-right: 0.2rem;
            border-radius: 3px;
            cursor: pointer;

            &:last-child {
                margin-right: 0;
            }

            &:hover {
                background-color: rgba(#ffffff, 0.1);
            }

            &.is-active {
                background-color: rgba(#ffffff, 0.2);
            }
        }

        &__form {
            display: flex;
            align-items: center;
        }

        &__input {
            font: inherit;
            border: none;
            background: transparent;
            color: #ffffff;
        }
    }

    .editor__content > div {
        border: 1px solid #ffffff;
        border-radius: 5px;
        padding: 0.5rem;
    }
</style>

<script>
    import {
        Editor, EditorContent, EditorMenuBar, EditorMenuBubble
    } from 'tiptap'
    import {
        Blockquote, CodeBlock, HardBreak, Heading, HorizontalRule, OrderedList, History,
        BulletList, ListItem, TodoItem, TodoList, Bold, Code, Italic, Link, Strike, Underline,
    } from 'tiptap-extensions'

    export default {
        components: {
            EditorContent,
            EditorMenuBar,
            EditorMenuBubble
        },
        data() {
            return {
                editor: new Editor({
                    extensions: [
                        new Blockquote(),
                        new BulletList(),
                        new CodeBlock(),
                        new HardBreak(),
                        new Heading({
                            levels: [1, 2, 3]
                        }),
                        new HorizontalRule(),
                        new ListItem(),
                        new OrderedList(),
                        new TodoItem(),
                        new TodoList(),
                        new Link(),
                        new Bold(),
                        new Code(),
                        new Italic(),
                        new Strike(),
                        new Underline(),
                        new History(),
                    ],
                    content: this.content,
                }),
                linkUrl: null,
                linkMenuIsActive: false,
            }
        },
        methods: {
            showLinkMenu(attrs) {
                this.linkUrl = attrs.href
                this.linkMenuIsActive = true
                this.$nextTick(() => {
                    this.$refs.linkInput.focus()
                })
            },
            hideLinkMenu() {
                this.linkUrl = null
                this.linkMenuIsActive = false
            },
            setLinkUrl(command, url) {
                command({ href: url })
                this.hideLinkMenu()
            },
        },
        beforeDestroy() {
            this.editor.destroy()
        },
        props: {
            content: String
        }
    }

</script>