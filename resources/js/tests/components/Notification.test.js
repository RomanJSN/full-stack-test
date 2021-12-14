import Vue from 'vue'
import Vuex from 'vuex'
import Vuetify from 'vuetify';
import { shallowMount, createLocalVue } from '@vue/test-utils'
import Filters from '@/components/Notification.vue';

const localVue = createLocalVue()
Vue.use(Vuetify)
localVue.use(Vuex)

const store = new Vuex.Store({
    modules: {
        notification: {
            namespaced: true,
            getters: {
                getMassage: jest.fn().mockReturnValue({
                    show: false,
                    text: ''
                })
            },
        }
    }
})

const vuetify = new Vuetify()

describe('Notification', () => {
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
});
