import { GUI } from './gui';
import { API } from './api';
import { parse } from '../../../lib/html';
import DOM, { delegate, once } from 'typed-dom';

describe('Unit: layer/interface/gui', function () {
  describe('assign', function () {
    it('', function (done) {
      assert(GUI.assign === API.assign);
      new GUI({}, { document, router: config => {
        assert(config.replace as string !== '*');
        done();
        return Promise.resolve();
      }})
        .assign('');
    });

  });

  describe('replace', function () {
    it('', function (done) {
      assert(GUI.replace === API.replace);
      new GUI({}, { document, router: config => {
        assert(config.replace as string === '*');
        done();
        return Promise.resolve();
      }})
        .replace('');
    });

  });

  describe('click', function () {
    it('valid', function (done) {
      const document = parse('<a href=""></a>').extract();
      new GUI({}, { document, router: (_, ev) => {
        ev.preventDefault();
        return Promise.resolve();
      }});
      delegate(document, 'a', 'click', ev => {
        assert(ev.defaultPrevented === true);
        done();
      });
      document.querySelector('a')!.click();
    });

    it('external', function (done) {
      const document = parse('<a href="//remote/"></a>').extract();
      new GUI({}, { document, router: (_, ev) => {
        ev.preventDefault();
        return Promise.resolve();
      }});
      delegate(document, 'a', 'click', ev => {
        assert(ev.defaultPrevented === false);
        done();
      });
      document.querySelector('a')!.click();
    });

    it('hash', function (done) {
      const document = parse('<a href="#"></a>').extract();
      new GUI({}, { document, router: (_, ev) => {
        ev.preventDefault();
        return Promise.resolve();
      }});
      delegate(document, 'a', 'click', ev => {
        assert(ev.defaultPrevented === false);
        done();
      });
      document.querySelector('a')!.click();
    });

    it('download', function (done) {
      const document = parse('<a href="" download></a>').extract();
      new GUI({}, { document, router: (_, ev) => {
        ev.preventDefault();
        return Promise.resolve();
      }});
      delegate(document, 'a', 'click', ev => {
        assert(ev.defaultPrevented === false);
        done();
      });
      document.querySelector('a')!.click();
    });

  });

  describe('submit', function () {
    it('valid', function (done) {
      const form = DOM.form({ action: '' }, [
        DOM.input({ type: 'submit', value: 'submit' }),
      ]).element;
      document.body.appendChild(form);
      new GUI({}, { document, router: (_, ev) => {
        ev.preventDefault();
        return Promise.resolve();
      }});
      once(document, 'form', 'submit', ev => {
        assert(ev.defaultPrevented === true);
        done();
      });
      form.querySelector('input')!.click();
    });

    it('external', function (done) {
      const form = DOM.form({ action: '//remote/' }, [
        DOM.input({ type: 'submit', value: 'submit' }),
      ]).element;
      document.body.appendChild(form);
      new GUI({}, { document, router: (_, ev) => {
        ev.preventDefault();
        return Promise.resolve();
      }});
      once(document, 'form', 'submit', ev => {
        assert(ev.defaultPrevented === false);
        ev.preventDefault();
        done();
      });
      form.querySelector('input')!.click();
    });

  });

});
