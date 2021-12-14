import axios from 'axios'
import articles from '@/store/categories.js'
import { notify } from '@/helpers/vuex-helpers'
import { ERROR } from '@/constants/message'

jest.mock('axios', () => ({
    get: jest.fn().mockReturnValueOnce(
        Promise.resolve(
            {
                data: [{test: 1}]
            }
        )
    ).mockReturnValue(Promise.reject()),
}))

jest.mock('@/helpers/vuex-helpers', () => ({
    notify: jest.fn()
}))

describe('getters', () => {
    test('call method getCategories', () => {
        let art = articles.getters.getCategories({ categories: [] })
        expect(art).toHaveLength(0)
        art = articles.getters.getCategories({ categories: [{}] })
        expect(art).toHaveLength(1)
    })
})

describe('mutations', () => {
    test('call method updateCategories', () => {
        const state = {
            categories: [],
        }
        articles.mutations.updateCategories(state, [{}])
        expect(state.categories).toHaveLength(1)
        expect(state.categories).toEqual([{}])
    })
})

describe('actions', () => {
    test('call method findCategories', async () => {
        const vuexData = {
            commit: jest.fn(),
        }
        await articles.actions.findCategories(vuexData, {})
        expect(vuexData.commit).toBeCalledWith('updateCategories', [{test: 1}])
        expect(notify).not.toBeCalled()

        await articles.actions.findCategories(vuexData, {})
        expect(notify).toBeCalledWith(vuexData.commit, ERROR)
    })
})
