import React, { useEffect } from 'react';

import { kiwicomData } from '../config';

const getSrc = script => {
  if (script === '<script></script>' || !script) {
    return '';
  }
  const splittedScript = script.split('\nsrc="');
  const splittedSrc = splittedScript[1].split('\">\n</script>')[0];
  return splittedSrc;
};

const Builder = props => {
  const { clientId } = props;

  const containerId = `${clientId}-container-id`;
  const iframeId = `${clientId}-iframe-id`;

  useEffect(() => {
    const script = document.createElement('script');

    script.src = 'https://widgets.kiwi.com/scripts/widget-builder-iframe.js';
    script.setAttribute('data-affilid', kiwicomData.affiliateID);
    script.setAttribute('data-container-id', containerId);
    script.setAttribute('data-iframe-id', iframeId);
    script.setAttribute('data-result-container-id', containerId);
    script.setAttribute('data-result-iframe-id', iframeId);
    script.setAttribute('data-ui', 'wordpress-plugin');
    script.setAttribute('data-link', getSrc(props.attributes.script));
    script.setAttribute('data-script', btoa(encodeURIComponent(props.attributes.script)));

    document.body.appendChild(script);

    window.addEventListener('message', event => {
      if (event.data.iframeId !== iframeId || event.data.id !== 'builderScript') {
        return;
      }

      props.setAttributes({
        script: event.data.script,
      });
    });

    return () => {
      document.body.removeChild(script);
    };
  }, []);

  return <div id={containerId}></div>;
};

export default Builder;
