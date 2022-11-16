<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl leading-tight">
                <Link
                    class="text-indigo-400 hover:text-indigo-600"
                    :href="route('pedidos-itens.index')"
                    >PedidosItens
                </Link>
                <span class="text-indigo-400 font-medium">/</span>
                Criar PedidosIten
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
                                    >Id Pedidos</label
                                >
                                <select id="id_pedidos" v-model="form.id_pedidos" name="pedidos" class="
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

                                    <option v-for="pedido in pedidos" :key="pedido.id" :value="pedido.id">
                                        {{ pedido.id }}
                                    </option>

                                    <p class="error text-red-700" v-if="errors.id_pedidos">{{ errors.id_pedidos }}</p>
                                </select>
                            </div>
                            <div class="grid grid-cols-1">
                                <label
                                    class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold"
                                    >Id Servicos</label
                                >
                                <select id="id_servicos" v-model="form.id_servicos" name="servicos" class="
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

                                    <option v-for="servico in servicos" :key="servico.id" :value="servico.id">
                                        {{ servico.descricao }}
                                    </option>

                                    <p class="error text-red-700" v-if="errors.id_servicos">{{ errors.id_servicos }}</p>
                                </select>
                            </div>
                            <div class="grid grid-cols-1">
                                <label
                                    class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold"
                                    >Peso Medio Peca</label
                                >
                                <input
                                    id="peso_medio_peca"
                                    v-model="form.peso_medio_peca"
                                    class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                    type="text"
                                    placeholder=""
                                />
                                <p
                                    class="error text-red-700"
                                    v-if="errors.peso_medio_peca"
                                >
                                    {{ errors.peso_medio_peca }}
                                </p>
                            </div>
                            <div class="grid grid-cols-1">
                                <label
                                    class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold"
                                    >Valor</label
                                >
                                <input
                                    id="valor"
                                    v-model="form.valor"
                                    class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                    type="text"
                                    placeholder=""
                                />
                                <p
                                    class="error text-red-700"
                                    v-if="errors.valor"
                                >
                                    {{ errors.valor }}
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
                            
                            
                            <div class="grid grid-cols-1">
                                <label
                                    class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold"
                                    >Descricao</label
                                >
                                <input
                                    id="descricao"
                                    v-model="form.descricao"
                                    class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                    type="text"
                                    placeholder=""
                                />
                                <p
                                    class="error text-red-700"
                                    v-if="errors.descricao"
                                >
                                    {{ errors.descricao }}
                                </p>
                            </div>
                            <div class="grid grid-cols-1">
                                <label
                                    class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold"
                                    >Quantidade</label
                                >
                                <input
                                    id="quantidade"
                                    v-model="form.quantidade"
                                    class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                    type="text"
                                    placeholder=""
                                />
                                <p
                                    class="error text-red-700"
                                    v-if="errors.quantidade"
                                >
                                    {{ errors.quantidade }}
                                </p>
                            </div>
                            <div class="grid grid-cols-1">
                                <label
                                    class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold"
                                    >Produto Clientes</label
                                >
                                <input
                                    id="produto_clientes"
                                    v-model="form.produto_clientes"
                                    class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                    type="text"
                                    placeholder=""
                                />
                                <p
                                    class="error text-red-700"
                                    v-if="errors.produto_clientes"
                                >
                                    {{ errors.produto_clientes }}
                                </p>
                            </div>
                        </div>

                        <div
                            class="flex justify-end md:gap-8 gap-4 pt-5 pb-5 pr-5"
                        >
                            <Link
                                :href="route('pedidos-itens.index')"
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
    props: ["errors","pedidos","status","servicos"],
    data() {
        return {
            form: {
                id_pedidos: null,
                id_servicos: null,
                peso_medio_peca: null,
                valor: null,
                status: null,
                descricao: null,
                quantidade: null,
                produto_clientes: null,
            },
        };
    },
    methods: {
        submit() {
            this.$inertia.post(route("pedidos-itens.store"), this.form);
        },
    },
};
</script>
