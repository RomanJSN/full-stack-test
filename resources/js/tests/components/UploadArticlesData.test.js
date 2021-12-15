import Vue from 'vue'
import Vuex from 'vuex'
import Vuetify from 'vuetify';
import { shallowMount, createLocalVue } from '@vue/test-utils'
import Filters from '@/components/UploadArticlesData.vue';

const localVue = createLocalVue()
Vue.use(Vuetify)
localVue.use(Vuex)

const store = new Vuex.Store({
    modules: {
        articles: {
            namespaced: true,
            actions: {
                uploadArticlesData: jest.fn()
            },
        }
    }
})

const vuetify = new Vuetify()

describe('UploadArticlesData', () => {
    let wrapper
    beforeAll(() => {
        function FormDataMock() {}
        FormDataMock.prototype.append = function (key, value) {
            this[key] = value
        }
        global.FormData = FormDataMock
        wrapper = shallowMount(Filters, {
            store,
            localVue,
            vuetify
        });
    })
    test('is a Vue instance', () => {
        expect(wrapper.isVueInstance).toBeTruthy();
    });

    test('call methods uploadFile', () => {
        wrapper.vm.uploadArticlesData = jest.fn()
        wrapper.vm.uploadFile()
        expect(wrapper.vm.uploadArticlesData).toBeCalledWith({ file: null });
    });
});
