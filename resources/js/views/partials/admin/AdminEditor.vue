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

        <editor-content class="editor__content mt-10" :editor="editor" />
    </div>
</template>

<style>
    .editor__content > div {
        border: 1px solid white;
        border-radius: 5px;
        padding: 0.5rem;
    }
</style>

<script>
    import {
        Editor, EditorContent, EditorMenuBar
    } from 'tiptap'
    import {
        Blockquote, CodeBlock, HardBreak, Heading, HorizontalRule, OrderedList, History,
        BulletList, ListItem, TodoItem, TodoList, Bold, Code, Italic, Link, Strike, Underline,
    } from 'tiptap-extensions'

    export default {
        components: {
            EditorContent,
            EditorMenuBar,
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
                    content: this.content
                }),
            }
        },
        beforeDestroy() {
            this.editor.destroy()
        },
        props: {
            content: String
        }
    }

</script>