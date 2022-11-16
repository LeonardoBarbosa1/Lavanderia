<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl leading-tight">
                <Link class="text-indigo-400 hover:text-indigo-600" :href="route('pedidos.index')">Pedidos </Link>
                <span class="text-indigo-400 font-medium">/</span>
                Editar Pedido
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                    <form @submit.prevent="submit" class="mb-6">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">

                            <div class="grid grid-cols-1">
                                <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Id
                                    Clientes</label>
                                <select id="id_clientes" v-model="form.id_clientes" name="clientes" class="
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

                                    <option v-for="cliente in clientes" :key="cliente.id" :value="cliente.id">
                                        {{ cliente.nome }}
                                    </option>

                                    <p class="error text-red-700" v-if="errors.id_clientes">{{ errors.id_clientes }}</p>
                                </select>
                                <!--<label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">
                                    Cliente</label>
                                <input id="id_clientes" v-model="form.id_clientes"
                                    class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                    type="text" placeholder="" />
                                <p class="error text-red-700" v-if="errors.id_clientes">{{ errors.id_clientes }}</p>-->
                            </div>

                            <div class="grid grid-cols-1">
                                <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Data
                                    Pedido</label>
                                 <Datepicker id="data_pedido" v-model="form.data_pedido" 
                                    :enableTimePicker="false"
                                    :allowedDates="escalas_dias" 
                                    :locale="date-fns/locale/pt"
                                    :disabledWeekDays="disabled_weekdays" />
                                <p class="error text-red-700" v-if="errors.data_pedido">{{ errors.data_pedido }}</p>
                                <!--<label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Data do
                                    Pedido</label>
                                <input id="data_pedido" v-model="form.data_pedido"
                                    class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                    type="text" placeholder="" />
                                <p class="error text-red-700" v-if="errors.data_pedido">{{ errors.data_pedido }}</p>-->
                            </div>

                            <div class="grid grid-cols-1">
                                <label
                                    class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Situacao</label>

                                    <select id="situacao" v-model="form.situacao" name="situacao" class="
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

                                    <option v-for="situacoes in situacao" :key="situacoes.id" :value="situacoes.id">
                                        {{ situacoes.descricao }}
                                    </option>
                                    <p class="error text-red-700" v-if="errors.situacao">{{ errors.situacao }}</p>
                                </select>

                        <!--<input id="situacao" v-model="form.situacao"
                                    class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                    type="text" placeholder="" />
                                <p class="error text-red-700" v-if="errors.situacao">{{ errors.situacao }}</p>-->
                            </div>

                            <div class="grid grid-cols-1">
                                <label
                                    class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Status</label>
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
                                <!--<label
                                    class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Status</label>
                                <input id="status" v-model="form.status"
                                    class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                    type="text" placeholder="" />
                                <p class="error text-red-700" v-if="errors.status">{{ errors.status }}</p>-->
                            </div>

                            <!--<div class="grid grid-cols-1">
                                <label
                                    class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Created
                                    By</label>
                                <input id="created_by" v-model="form.created_by"
                                    class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                    type="text" placeholder="" />
                                <p class="error text-red-700" v-if="errors.created_by">{{ errors.created_by }}</p>
                            </div>
                            <div class="grid grid-cols-1">
                                <label
                                    class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Updated
                                    By</label>
                                <input id="updated_by" v-model="form.updated_by"
                                    class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                    type="text" placeholder="" />
                                <p class="error text-red-700" v-if="errors.updated_by">{{ errors.updated_by }}</p>
                            </div>-->
                            
                            
                            <div class="grid grid-cols-1">
                                <label
                                    class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Descricao</label>
                                <input id="descricao" v-model="form.descricao"
                                    class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                                    type="text" placeholder="" />
                                <p class="error text-red-700" v-if="errors.descricao">{{ errors.descricao }}</p>
                            </div>


                        </div>

                        <div class='flex justify-end md:gap-8 gap-4 pt-5 pb-5 pr-5'>
                            <Link :href="route('pedidos.index')"
                                class='w-auto bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'
                                type="button">
                            Cancelar
                            </Link>
                            <button type="submit"
                                class='w-auto bg-purple-500 hover:bg-purple-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>
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
import { Link } from '@inertiajs/inertia-vue3';
import Datepicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
export default {
    components: {
        AppLayout,
        Datepicker,
        Link
    },
    props: ['pedido', 'errors','situacao','clientes','status',],
    data() {
        return {
            form: {
                situacao: this.$props.pedido.situacao,
                status: this.$props.pedido.status,
                data_pedido: this.$props.pedido.data_pedido,
                id_clientes: this.$props.pedido.id_clientes,
                descricao: this.$props.pedido.descricao,

            },
        };
    },
    methods: {
        submit() {
            this.$inertia.put(
                route("pedidos.update", this.$props.pedido.id),
                this.form
            );
        },
    },
};
</script>