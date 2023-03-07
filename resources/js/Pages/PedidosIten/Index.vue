<template   >
    <app-layout >
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                PedidosItens
            </h2>
        </template>

        <div
            
            class="flex items-center justify-center"
            style="background: #edf2f7"
        >
            <div class="container">
                <div class="mb-2 mt-6 flex justify-between items-center block">
                    <div class="px-0 my-3 rounded-xl flex flex-col">
                        <div class="">
                            <form
                                class="bg-white font-semibold rounded-lg px-10 grid-flow-row-dense pt-8 pb-8 mb-4"
                            >
                                <div v-for="pedidos in pedido" :key="pedidos.id">
                                    <span> Id Pedido: {{ pedidos.id }} </span>
                                    <br />

                                    <span
                                        v-for="c in cliente"
                                        :key="cliente.nome"
                                    >
                                        Cliente: {{ c.nome }}
                                    </span>
                                    <br />

                                    <span>
                                        Descrição: {{ pedidos.descricao }}
                                    </span>
                                    <br />
                                </div>
                            </form>
                        </div>
                        <br />

                        
                            <div
                                
                                class="w-full">
                                <Link
                                    :href="route('pedidos-item-create', pedidoId)"
                                    
                                    class="focus:outline-none text-white text-sm py-2.5 px-5 border-b-4 border-blue-600 rounded-md bg-blue-500 hover:bg-blue-400"
                                >
                                    Novo Item</Link
                                >

                                <a
                                    type="button"
                                    class="focus:outline-none text-white text-sm py-2.5 px-5 ml-2 border-b-4 border-green-600 rounded-md bg-green-700 hover:bg-green-500"
                                    :href="
                                        route('pedidos-itens.export', {
                                            term: this.term,
                                        })
                                    "
                                    download="file.xlsx"
                                >
                                    Exportar
                                </a>
                            </div>
                        </div>

                        <div class="w-full max-w-max  flex-row-reverse mr-0">
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
                            <th
                                class="bg-indigo-500 p-2 text-white font-bold md:border md:border-indigo-500 text-left block md:table-cell"
                            >
                                Id
                            </th>
                            <th
                                class="bg-indigo-500 p-2 text-white font-bold md:border md:border-indigo-500 text-left block md:table-cell"
                            >
                                Id Servicos
                            </th>
                            <th
                                class="bg-indigo-500 p-2 text-white font-bold md:border md:border-indigo-500 text-left block md:table-cell"
                            >
                                Peso Medio Peca
                            </th>
                            <th
                                class="bg-indigo-500 p-2 text-white font-bold md:border md:border-indigo-500 text-left block md:table-cell"
                            >
                                Valor
                            </th>
                            <th
                                class="bg-indigo-500 p-2 text-white font-bold md:border md:border-indigo-500 text-left block md:table-cell"
                            >
                                Status
                            </th>

                            <th
                                class="bg-indigo-500 p-2 text-white font-bold md:border md:border-indigo-500 text-left block md:table-cell"
                            >
                                Descricao
                            </th>
                            <th
                                class="bg-indigo-500 p-2 text-white font-bold md:border md:border-indigo-500 text-left block md:table-cell"
                            >
                                Quantidade
                            </th>
                            <th
                                class="bg-indigo-500 p-2 text-white font-bold md:border md:border-indigo-500 text-left block md:table-cell"
                            >
                                Produto Clientes
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
                            v-for="pedidosIten in pedidosItens.data"
                            :key="pedidosIten.id"
                            class="bg-white border border-grey-500 md:border-none block md:table-row"
                        >
                            <td
                                class="p-2 md:border md:border-grey-500 text-left block md:table-cell"
                            >
                                <span
                                    class="inline-block w-1/3 md:hidden font-bold"
                                    >Id Pedidos</span
                                >{{ pedidosIten.id }}
                            </td>
                            <td
                                class="p-2 md:border md:border-grey-500 text-left block md:table-cell"
                            >
                                <span
                                    class="inline-block w-1/3 md:hidden font-bold"
                                    >Id Servicos</span
                                >{{ pedidosIten.servico }}
                            </td>
                            <td
                                class="p-2 md:border md:border-grey-500 text-left block md:table-cell"
                            >
                                <span
                                    class="inline-block w-1/3 md:hidden font-bold"
                                    >Peso Medio Peca</span
                                >{{ pedidosIten.peso_medio_peca }}
                            </td>
                            <td
                                class="p-2 md:border md:border-grey-500 text-left block md:table-cell"
                            >
                                <span
                                    class="inline-block w-1/3 md:hidden font-bold"
                                    >Valor</span
                                >{{ pedidosIten.valor }}
                            </td>
                            <td
                                class="p-2 md:border md:border-grey-500 text-left block md:table-cell"
                            >
                                <span
                                    class="inline-block w-1/3 md:hidden font-bold"
                                    >Status</span
                                >{{ pedidosIten.status }}
                            </td>

                            <td
                                class="p-2 md:border md:border-grey-500 text-left block md:table-cell"
                            >
                                <span
                                    class="inline-block w-1/3 md:hidden font-bold"
                                    >Descricao</span
                                >{{ pedidosIten.descricao }}
                            </td>
                            <td
                                class="p-2 md:border md:border-grey-500 text-left block md:table-cell"
                            >
                                <span
                                    class="inline-block w-1/3 md:hidden font-bold"
                                    >Quantidade</span
                                >{{ pedidosIten.quantidade }}
                            </td>
                            <td
                                class="p-2 md:border md:border-grey-500 text-left block md:table-cell"
                            >
                                <span
                                    class="inline-block w-1/3 md:hidden font-bold"
                                    >Produto Clientes</span
                                >{{ pedidosIten.produto_clientes }}
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
                                    :href="
                                        route(
                                            'pedidos-itens.show',
                                            pedidosIten.id
                                        )
                                    "
                                >
                                    <span
                                        class="rounded-full text-white shadow-lg"
                                    >
                                        <img
                                            src="/storage/img/view.png"
                                            width="32"
                                            height="32"
                                        />
                                    </span>
                                </Link>
                                <Link
                                    class="m-1 bg-green-700 hover:bg-green-800 text-white font-bold py-2 px-2 rounded"
                                    as="button"
                                    type="button"
                                    :href="
                                        route(
                                            'pedidos-itens.edit',
                                            pedidosIten.id
                                        )
                                    "
                                >
                                    <span
                                        class="rounded-full text-white shadow-lg"
                                    >
                                        <img
                                            src="/storage/img/lapis.png"
                                            width="32"
                                            height="32"
                                        />
                                    </span>
                                </Link>

                                <button
                                    class="m-1 bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-2 rounded"
                                    tabindex="-1"
                                    type="button"
                                    @click="destroy(pedidosIten)"
                                >
                                    <span
                                        class="rounded-full text-white shadow-lg"
                                    >
                                        <img
                                            src="/storage/img/lixeira.png"
                                            width="32"
                                            height="32"
                                        />
                                    </span>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <pagination class="mt-6" :links="pedidosItens.links" />
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
        pedidosItens: Object,
        pedido: Object,
        cliente: Object,
     
    },
    
    
    data() {
        console.log("===================>",this.pedido[0]['id']);
      
        return {
            term: "",
            pedidoId:this.pedido[0]['id'],
            
            
            
        };
    },
    components: {
        AppLayout,
        Link,
        Pagination,
    },
    methods: {
        destroy(pedidosIten) {
            if (confirm("Você tem certeza que deseja excluir este registro?")) {
                this.$inertia.delete(
                    this.route("pedidos-itens.destroy", pedidosIten.id)
                );
            }
        },
        search() {
            this.$inertia.replace(
                this.route("pedidos-itens.index", { term: this.term })
            );
        },
        
    },
}    
    
</script>





