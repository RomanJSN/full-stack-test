import Vue from 'vue'
import Vuex from 'vuex'
import Vuetify from 'vuetify';
import { shallowMount, createLocalVue } from '@vue/test-utils'
import Filters from '@/components/Filters.vue';

const localVue = createLocalVue()
Vue.use(Vuetify)
localVue.use(Vuex)

const store = new Vuex.Store({
    modules: {
        articles: {
            namespaced: true,
            getters: {
                getArticles: jest.fn()
            },
            actions: {
                findArticles: jest.fn()
            }
        },
        categories: {
            namespaced: true,
            getters: {
                getCategories: jest.fn()
            },
            actions: {
                findCategories: jest.fn()
            }
        }
    }
})

const vuetify = new Vuetify()

describe('Filters', () => {
    let wrapper
    beforeAll(() => {
        wrapper = shallowMount(Filters, {
            store,
            localVue,
            vuetify
        });
    })
    test('is a Vue instance', () => {
        expect(wrapper.isVueInstance).toBeTruthy();
    });

    test('call search method without params', () => {
        wrapper.vm.findArticles = jest.fn()
        wrapper.vm.search()

        expect(wrapper.vm.findArticles).toBeCalledWith({});
    });
    test('call search method with params', () => {
        wrapper.vm.filterData.categories = [1,2,3]
        wrapper.vm.findArticles = jest.fn()
        wrapper.vm.search()

        expect(wrapper.vm.findArticles).toBeCalledWith({
            categories: '1,2,3'
        });
    });
});
