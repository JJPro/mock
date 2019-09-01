import metadata from './block.json';
import edit from './edit';

const { name, title, category, description, keywords, attributes } = metadata;

export { metadata, name };
export const settings = {
  title,
  description,
  category,
  icon: 'tickets-alt',
  keywords,
  supports: { html: false, },
  attributes,
  edit,
  useOnce: true,
};