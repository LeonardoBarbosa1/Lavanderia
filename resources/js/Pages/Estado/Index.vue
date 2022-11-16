<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Estados
            </h2>
        </template>

        <div
            class="flex items-center justify-center"
            style="background: #edf2f7"
        >
            <div class="container">
                <div class="mb-2 mt-6 flex justify-between items-center block">
                    <div class="px-0 my-3 rounded-xl flex flex-col">
                        <div class="w-full">
                            <Link
                                :href="route('estados.create')"
                                class="focus:outline-none text-white text-sm py-2.5 px-5 border-b-4 border-blue-600 rounded-md bg-blue-500 hover:bg-blue-400"
                                >Novo</Link
                            >

                            <a
                                type="button"
                                class="focus:outline-none text-white text-sm py-2.5 px-5 ml-2 border-b-4 border-green-600 rounded-md bg-green-700 hover:bg-green-500"
                                :href="
                                    route('estados.export', { term: this.term })
                                "
                                download="file.xlsx"
                            >
                                Exportar
                            </a>
                        </div>
                    </div>

                    <div class="w-full max-w-max mr-0">
                        <label for="search" class="p-2 text-gray-700"
                            >Filtro</label
                        >
                        <input
                            id="search"
                            type="text"
                            v-model="term"
                            @keyup.enter="search"
                            class="px-2 py-1 text-sm rounded border"
                        />
                    </div>
                </div>

                <table class="min-w-full border-collapse block md:table">
                    <thead class="block md:table-header-group">
                        <tr
                            class="border border-indigo-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto md:relative"
                        >
                            <!--<th
                                class="bg-indigo-500 p-2 text-white font-bold md:border md:border-indigo-500 text-left block md:table-cell"
                            >
                                Updated By
                            </th>-->
                            <th
                                class="bg-indigo-500 p-2 text-white font-bold md:border md:border-indigo-500 text-left block md:table-cell"
                            >
                                Nome
                            </th>

                            
                            <!--<th
                                class="bg-indigo-500 p-2 text-white font-bold md:border md:border-indigo-500 text-left block md:table-cell"
                            >
                                Created By
                            </th>-->
                            
                            <th
                                class="bg-indigo-500 p-2 text-white font-bold md:border md:border-indigo-500 text-left block md:table-cell"
                            >
                                Sigla
                            </th>

                            <th
                                class="bg-indigo-500 p-2 text-white font-bold md:border md:border-indigo-500 text-left block md:table-cell"
                            >
                                Status
                            </th>

                            <th
                                class="bg-indigo-500 p-2 text-white font-bold md:border md:border-indigo-300 text-left block md:table-cell"
                            >
                                Ações
                            </th>
                        </tr>
                    </thead>
                    <tbody class="block md:table-row-group">
                        <tr
                            v-for="estado in estados.data"
                            :key="estado.id"
                            class="bg-white border border-grey-500 md:border-none block md:table-row"
                        >
                           <!-- <td
                                class="p-2 md:border md:border-grey-500 text-left block md:table-cell"
                            >
                                <span
                                    class="inline-block w-1/3 md:hidden font-bold"
                                    >Updated By</span
                                >{{ estado.updated_by }}
                            </td>-->
                            
                            <!--<td
                                class="p-2 md:border md:border-grey-500 text-left block md:table-cell"
                            >
                                <span
                                    class="inline-block w-1/3 md:hidden font-bold"
                                    >Created By</span
                                >{{ estado.created_by }}
                            </td>-->
                            <td
                                class="p-2 md:border md:border-grey-500 text-left block md:table-cell"
                            >
                                <span
                                    class="inline-block w-1/3 md:hidden font-bold"
                                    >Nome</span
                                >{{ estado.nome }}
                            </td>
                            <td
                                class="p-2 md:border md:border-grey-500 text-left block md:table-cell"
                            >
                                <span
                                    class="inline-block w-1/3 md:hidden font-bold"
                                    >Sigla</span
                                >{{ estado.sigla }}
                            </td>
                            
                            <td
                                class="p-2 md:border md:border-grey-500 text-left block md:table-cell"
                            >
                                <span
                                    class="inline-block w-1/3 md:hidden font-bold"
                                    >Status</span
                                >{{ estado.status }}
                            </td>

                            <td
                                class="p-2 md:border md:border-grey-500 text-left block md:table-cell"
                            >
                                <span
                                    class="inline-block w-1/3 md:hidden font-bold"
                                    >Ações</span
                                >
                                <Link
                                    class="m-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded"
                                    as="button"
                                    type="button"
                                    :href="route('estados.show', estado.id)"
                                >
                                    <span class="rounded-full text-white shadow-lg">
                                        <img  src="/storage/img/view.png" width="32" height="32"/> 
                                    </span> 
                                </Link>
                                <Link
                                    class="m-1 bg-green-700 hover:bg-green-800 text-white font-bold py-2 px-2 rounded"
                                    as="button"
                                    type="button"
                                    :href="route('estados.edit', estado.id)"
                                >
                                    <span class="rounded-full text-white shadow-lg">
                                        <img  src="/storage/img/lapis.png" width="32" height="32"/> 
                                    </span> 
                                </Link>

                                <button
                                    class="m-1 bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-2 rounded"
                                    tabindex="-1"
                                    type="button"
                                    @click="destroy(estado)"
                                >
                                    <span class="rounded-full text-white shadow-lg">
                                        <img  src="/storage/img/lixeira.png" width="32" height="32"/> 
                                    </span>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <pagination class="mt-6" :links="estados.links" />
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import Pagination from "@/Shared/Pagination";

export default {
    props: {
        estados: Object,
    },
    data() {
        return {
            term: "",
        };
    },
    components: {
        AppLayout,
        Link,
        Pagination,
    },
    methods: {
        destroy(estado) {
            if (confirm("Você tem certeza que deseja excluir este registro?")) {
                this.$inertia.delete(this.route("estados.destroy", estado.id));
            }
        },
        search() {
            this.$inertia.replace(
                this.route("estados.index", { term: this.term })
            );
        },
    },
};
</script>
