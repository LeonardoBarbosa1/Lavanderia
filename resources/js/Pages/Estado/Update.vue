<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl leading-tight">
                <Link
                    class="text-indigo-400 hover:text-indigo-600"
                    :href="route('estados.index')"
                    >Estados
                </Link>
                <span class="text-indigo-400 font-medium">/</span>
                Editar Estado
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <form @submit.prevent="submit" class="mb-6">
                        <div
                            class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7"
                        >
                            <div class="grid grid-cols-1">
                                <label
                                    class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold"
                                    >Nome</label
                                >
                                <input
                                    id="nome"
                                    v-model="form.nome"
                                    class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                    type="text"
                                    placeholder=""
                                />
                                <p
                                    class="error text-red-700"
                                    v-if="errors.nome"
                                >
                                    {{ errors.nome }}
                                </p>
                            </div>
                            <!--<div class="grid grid-cols-1">
                                <label
                                    class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold"
                                    >Updated By</label
                                >
                                <input
                                    id="updated_by"
                                    v-model="form.updated_by"
                                    class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                    type="text"
                                    placeholder=""
                                />
                                <p
                                    class="error text-red-700"
                                    v-if="errors.updated_by"
                                >
                                    {{ errors.updated_by }}
                                </p>
                            </div>-->
                           
                            <!--<div class="grid grid-cols-1">
                                <label
                                    class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold"
                                    >Created By</label
                                >
                                <input
                                    id="created_by"
                                    v-model="form.created_by"
                                    class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                    type="text"
                                    placeholder=""
                                />
                                <p
                                    class="error text-red-700"
                                    v-if="errors.created_by"
                                >
                                    {{ errors.created_by }}
                                </p>
                            </div>-->
                            
                            <div class="grid grid-cols-1">
                                <label
                                    class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold"
                                    >Sigla</label
                                >
                                <input
                                    id="sigla"
                                    v-model="form.sigla"
                                    class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                    type="text"
                                    placeholder=""
                                />
                                <p
                                    class="error text-red-700"
                                    v-if="errors.sigla"
                                >
                                    {{ errors.sigla }}
                                </p>
                            </div>
                             <div class="grid grid-cols-1">
                                <label
                                    class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold"
                                    >Status</label
                                >
                                <select id="status" v-model="form.status" name="status" class="
                                            py-2                              
                                            px-3
                                            rounded-lg
                                            border-2 border-purple-300
                                            mt-1
                                            focus:outline-none
                                            focus:ring-2
                                            focus:ring-purple-600
                                            focus:border-transparent
                                    
                                        ">

                                            <option v-for="statu in status" :key="statu.id" :value="statu.id">
                                                {{ statu.descricao }}
                                            </option>
                                            <p class="error text-red-700" v-if="errors.status">{{ errors.status }}</p>
                                </select>
                            </div>
                        </div>

                        <div
                            class="flex justify-end md:gap-8 gap-4 pt-5 pb-5 pr-5"
                        >
                            <Link
                                :href="route('estados.index')"
                                class="w-auto bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2"
                                type="button"
                            >
                                Cancelar
                            </Link>
                            <button
                                type="submit"
                                class="w-auto bg-purple-500 hover:bg-purple-700 rounded-lg shadow-xl font-medium text-white px-4 py-2"
                            >
                                Salvar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import { Link } from "@inertiajs/inertia-vue3";
export default {
    components: {
        AppLayout,
        Link,
    },
    props: ["estado", "errors","status",],
    data() {
        return {
            form: {
                
                status: this.$props.estado.status,
                nome: this.$props.estado.nome,
                sigla: this.$props.estado.sigla,
            },
        };
    },
    methods: {
        submit() {
            this.$inertia.put(
                route("estados.update", this.$props.estado.id),
                this.form
            );
        },
    },
};
</script>
