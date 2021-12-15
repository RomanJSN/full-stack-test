import Vuex from 'vuex'
import { shallowMount, createLocalVue } from '@vue/test-utils'
import ArticlesList from '@/components/ArticlesList.vue';

const localVue = createLocalVue()
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
        }
    }
})

describe('ArticlesList', () => {
    test('is a Vue instance', () => {
        const wrapper = shallowMount(ArticlesList, {
            store,
            localVue
        });
        expect(wrapper.isVueInstance).toBeTruthy();
    });
});
