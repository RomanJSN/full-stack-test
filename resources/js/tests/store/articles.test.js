import axios from 'axios'
import articles from '@/store/articles.js'
import { notify } from '@/helpers/vuex-helpers'
import { ERROR, SUCCESS } from '@/constants/message'

jest.mock('axios', () => ({
    get: jest.fn().mockReturnValueOnce(
        Promise.resolve(
            {
                data: [{test: 1}]
            }
        )
    ).mockReturnValue(Promise.reject()),
    post: jest.fn()
        .mockReturnValueOnce(Promise.resolve())
        .mockReturnValue(Promise.reject()),
}))
jest.mock('@/helpers/vuex-helpers', () => ({
    notify: jest.fn()
}))

describe('getters', () => {
    test('call method getArticles', () => {
        let art = articles.getters.getArticles({ articles: [] })
        expect(art).toHaveLength(0)
        art = articles.getters.getArticles({ articles: [{}] })
        expect(art).toHaveLength(1)
    })
    test('call method getIsLoading', () => {
        let isLoading = articles.getters.getIsLoading({ isLoading: true })
        expect(isLoading).toBeTruthy()
    })
})

describe('mutations', () => {
    test('call method updateArticles', () => {
        const state = {
            articles: [],
        }
        articles.mutations.updateArticles(state, [{}])
        expect(state.articles).toHaveLength(1)
        expect(state.articles).toEqual([{}])
    })
    test('call method updateIsLoading', () => {
        const state = {
            isLoading: false
        }
        articles.mutations.updateIsLoading(state, true)
        expect(state.isLoading).toBeTruthy()
    })
})

describe('actions', () => {
    test('call method findArticles', async () => {
        const vuexData = {
            state: {},
            commit: jest.fn(),
        }
        await articles.actions.findArticles(vuexData, {})
        expect(vuexData.commit).toBeCalledWith('updateIsLoading', true)
        expect(vuexData.commit).toBeCalledWith('updateArticles', [{test: 1}])
        expect(vuexData.commit).toBeCalledWith('updateIsLoading', false)
        expect(notify).not.toBeCalled()

        await articles.actions.findArticles(vuexData, {})
        expect(vuexData.commit).toBeCalledWith('updateIsLoading', true)
        expect(vuexData.commit).toBeCalledWith('updateIsLoading', false)
        expect(notify).toBeCalled()

    })
    test('call method uploadArticlesData', async () => {
        const vuexData = {
            state: {},
            commit: jest.fn(),
        }
        await articles.actions.uploadArticlesData(vuexData, {})
        expect(notify).toBeCalledWith(vuexData.commit, SUCCESS)

        await articles.actions.uploadArticlesData(vuexData, {})
        expect(notify).toBeCalledWith(vuexData.commit, ERROR)
    })
})
